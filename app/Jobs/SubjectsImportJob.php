<?php

namespace App\Jobs;

use App\Events\SubjectsImportEvent;
use App\Imports\SubjectsImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SubjectsImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;

    protected $programId;
    public function __construct($path)
    {
        $this->path = $path;
        $this->programId = auth()->user()->program->id;
        echo(sprintf($this->path));
    }

    public function handle()
    {
        try {
            Excel::import(new SubjectsImport ($this->programId), $this->path);
            // Emit event sukses setelah import selesai
            event(new SubjectsImportEvent('success', 'Import subject berhasil!'));
        } catch (\Exception $e) {
            // Emit event error jika gagal
            //echo sprintf('here is the message: %s', $e->getMessage()."\n");
            event(new SubjectsImportEvent('error', 'Import subject gagal: ' . $e->getMessage()));
        }
    }
}

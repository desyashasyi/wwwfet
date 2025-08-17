<?php
namespace App\Jobs;

use App\Imports\TeachersImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\TeachersImportEvent;

class TeachersImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;

    protected $programId;
    public function __construct($path)
    {
        $this->path = $path;
        $this->programId = auth()->user()->program->id;
    }

    public function handle()
    {
        try {
            Excel::import(new TeachersImport ($this->programId), $this->path);
            // Emit event sukses setelah import selesai
            event(new TeachersImportEvent('success', 'Import teacher berhasil!'));
        } catch (\Exception $e) {
            // Emit event error jika gagal
            //echo sprintf('here is the message: %s', $e->getMessage()."\n");
            event(new TeachersImportEvent('error', 'Import teacher gagal: ' . $e->getMessage()));
        }
    }
}




<?php
namespace App\Listeners;

use App\Events\TeachersImportEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TeachersImportListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(TeachersImportEvent $event)
    {
        // Pasang logika tambahan jika dibutuhkan, umumnya listener mengolah event,
        // tapi karena event broadcast langsung, bisa kosong.
        // Atau Anda bisa gunakan event ini untuk logic lain.
    }
}



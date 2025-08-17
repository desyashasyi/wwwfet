<?php
namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\TeachersImportEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TeachersImportEvent::class => [
            TeachersImportListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        //
    }
}

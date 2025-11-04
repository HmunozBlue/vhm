<?php

namespace App\Listeners;

use App\Events\VisitFinish;
use Illuminate\Support\Facades\Mail;
use App\Mail\VisitFinishMail;


class SendNotificationVisit
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VisitFinish  $event
     * @return void
     */
    public function handle(VisitFinish $event)
    {
        $visit = $event->visit;

        // Send notification logic here
        //$visit->user->notify(new VisitFinishedNotification($visit));

        Mail::to($visit->partner->email)->send(new VisitFinishMail($visit));

        \Log::info('Listener ejecutado para visita ID: '.$visit->id);

    }
}

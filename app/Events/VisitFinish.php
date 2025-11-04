<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visit;

class VisitFinish
{
    use Dispatchable, SerializesModels;

    public $visit;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }
}

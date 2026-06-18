<?php

namespace App\Observers;

use App\Events\DataUpdated;

class GlobalObserver
{
    public function saved($model)
    {
        DataUpdated::dispatch($model, 'saved');
    }

    public function deleted($model)
    {
        DataUpdated::dispatch($model, 'deleted');
    }
}

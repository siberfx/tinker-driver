<?php

namespace Siberfx\Tinker;

use Siberfx\Tinker\Commands\Tinker;
use Illuminate\Support\ServiceProvider;

class TinkerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            Tinker::class,
        ]);
    }
}

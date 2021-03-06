<?php

namespace Siberfx\Tinker\Commands;

use Siberfx\BotMan\BotManFactory;
use Siberfx\BotMan\Cache\ArrayCache;
use Siberfx\Tinker\Drivers\ConsoleDriver;
use Clue\React\Stdio\Stdio;
use Illuminate\Console\Command;
use React\EventLoop\Factory;

class Tinker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'botman:tinker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tinker around with BotMan.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var \Illuminate\Foundation\Application $app */
        $app = app('app');
        $loop = Factory::create();

        $app->singleton('botman', function ($app) use ($loop) {
            $config = config('services.botman', []);
            $botman = BotManFactory::create($config, new ArrayCache());

            $stdio = new Stdio($loop);
            $stdio->setPrompt('You: ');

            $botman->setDriver(new ConsoleDriver($config, $stdio));

            $stdio->on('data', function ($line) use ($botman) {
                $botman->listen();
            });

            return $botman;
        });

        if (file_exists('routes/botman.php')) {
            require base_path('routes/botman.php');
        }

        $loop->run();
    }
}

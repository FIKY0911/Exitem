<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ServeCommand as BaseServeCommand;
use Symfony\Component\Process\Process;

class ServeCommand extends BaseServeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server with Vite, Reverb, and Queue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting Laravel development services (Vite, Reverb, Queue)...');

        $processes = [
            'vite' => new Process(['npm', 'run', 'dev']),
            'reverb' => new Process(['php', 'artisan', 'reverb:start']),
            'queue' => new Process(['php', 'artisan', 'queue:listen', '--tries=1']),
        ];

        foreach ($processes as $name => $process) {
            $process->setTimeout(null);
            $process->start(function ($type, $buffer) use ($name) {
                if ($this->output->isVerbose()) {
                    $this->output->write("<fg=gray>[$name]</> $buffer");
                }
            });
        }

        try {
            return parent::handle();
        } finally {
            foreach ($processes as $process) {
                $process->stop();
            }
        }
    }
}

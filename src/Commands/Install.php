<?php

namespace DeDmytro\Metrics\Commands;

use DeDmytro\Metrics\MetricsServiceProvider;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'metrics:install';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Install Metrics and publish the required configurations.';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->line('Publishing assets and congigurations..');
        $this->call('vendor:publish', ['--provider' => MetricsServiceProvider::class, '--tag' => ['config', 'public']]);

        $this->info('Metrics successfully installed!');
        $this->info('Visit /metrics in your browser');
    }
}
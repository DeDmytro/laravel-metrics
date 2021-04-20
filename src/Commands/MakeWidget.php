<?php

namespace DeDmytro\Metrics\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputArgument;

class MakeWidget extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'metrics:widget 
                            {name : Class name} 
                            {--type=value : Widget type. [value, multiple])}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Create new Metrics widget';

    /**
     * The type of class being generated.
     * @var string
     */
    protected $type = 'Widget';

    /**
     * Handle the command
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        parent::handle();

        $this->info("To display your widget {$this->argument('name')} please add it to metrics.php config");
    }

    /**
     * Get the stub file for the generator.
     * @return string
     */
    protected function getStub()
    {
        switch ($this->option('type')) {
            case 'multiple':
                return __DIR__.'/stubs/Widgets/MultipleValue.stub';
            case 'value':
            default:
                return __DIR__.'/stubs/Widgets/Value.stub';
        }
    }

    /**
     * Get the default namespace for the class.
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Metrics\Widgets';
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the widget class.'],
        ];
    }

    /**
     * Rewrite class name.
     * @return string
     */
    protected function getNameInput()
    {
        return parent::getNameInput();
    }
}

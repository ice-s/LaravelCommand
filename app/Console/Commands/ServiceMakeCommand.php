<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ServiceMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'service:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $names = $this->argument('name');

        foreach ($names as $name) {
            $this->makeService($name);
        }
    }

    protected function isExistBaseService($path = '')
    {
        $path = app_path('/Http/Services');
        $baseFile = 'BaseService.php';
        if (!file_exists($path = app_path($path . "/" . $baseFile))) {
            mkdir($path, 0777, true);

            return true;
        }

        return false;
    }

    protected function isExistBaseRepository($path = '')
    {

    }

    protected function isExistBaseModel($path = '')
    {

    }

    protected function makeService($name)
    {
        if(!$this->isExistBaseService()){
            /*create base Service*/
            echo "BaseService not exist";
        }
        /*Create service*/

        /*Create Model*/
        $this->makeModel($name);

        /*Create Repository*/
        $this->makeRepository($name);
    }

    protected function makeRepository($name)
    {

    }

    protected function makeModel($name)
    {

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'The names of services will be created.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Generate a plain service (without some resources).'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the service already exists.'],
        ];
    }
}
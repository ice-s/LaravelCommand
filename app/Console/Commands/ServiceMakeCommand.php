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

        }
    }

    protected function isExistBaseService($path = '') {

    }

    protected function isExistBaseRepository($path = '') {

    }

    protected function isExistBaseModel($path = '') {

    }

    protected function makeService() {
        $this->makeModel();
        $this->makeRepository();
    }

    protected function makeRepository(){

    }

    protected function makeModel() {

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
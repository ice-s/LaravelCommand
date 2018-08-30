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
            $this->make($name);
        }
    }

    protected function isExistBaseService($path = '')
    {
        $baseFile = 'BaseService.php';
        $path = app_path('/Services');

        if (!file_exists(app_path("/Services/{$baseFile}"))) {
            $this->makeDir($path);

            $template = file_get_contents(resource_path("stubs/Base/BaseService.stub"));
            file_put_contents($path . "/{$baseFile}", $template);

            return false;
        }

        return true;
    }

    protected function isExistBaseRepository($path = '')
    {
        $baseFile = 'BaseRepository.php';
        $path = app_path('/Entities/Repositories');

        if (!file_exists(app_path("/Entities/Repositories/{$baseFile}"))) {
            $this->makeDir($path);

            $template = file_get_contents(resource_path("stubs/Base/BaseRepository.stub"));
            file_put_contents($path . "/{$baseFile}", $template);

            return false;
        }

        return true;
    }

    protected function isExistBaseModel($path = '')
    {
        $baseFile = 'BaseModel.php';
        $path = app_path('/Entities/Models');

        if (!file_exists(app_path("/Entities/Models/{$baseFile}"))) {
            $this->makeDir($path);

            $template = file_get_contents(resource_path("stubs/Base/BaseModel.stub"));
            file_put_contents($path . "/{$baseFile}", $template);

            return false;
        }

        return true;
    }

    protected function make($name)
    {
        if (!$this->isExistBaseService()) {
            /*create base Service*/
            echo "Create new Base Service\n";
        }
        /*Create service*/
        $this->makeService($name);

        if (!$this->isExistBaseModel()) {
            /*create base Service*/
            echo "Create new Base Model\n";
        }
        /*Create Model*/
        $this->makeModel($name);

        if (!$this->isExistBaseRepository()) {
            /*create base Service*/
            echo "Create new Base Repository\n";
        }
        /*Create Repository*/
        $this->makeRepository($name);
    }

    protected function makeService($name)
    {

        $serviceFolder = $name;
        $serviceClass = "{$name}Service.php";
        $folderPath = app_path("/Services/{$serviceFolder}");
        $fileName = app_path("/Services/{$serviceFolder}/{$serviceClass}");

        if (!file_exists($fileName)) {
            $this->makeDir($folderPath);

            $serviceTemplate = file_get_contents(resource_path("stubs/Service.stub"));
            $serviceTemplate = str_replace(['{{Name}}'], [$name], $serviceTemplate);
            file_put_contents($fileName, $serviceTemplate);

            return true;
        } else {
            echo "WARNING : Services is existed\n";

            return false;
        }
    }

    protected function makeRepository($name)
    {
        $repoFolder = $name;
        $repoClass = "{$name}Repository.php";
        $folderPath = app_path("/Entities/Repositories/{$repoFolder}");
        $fileName = app_path("/Entities/Repositories/{$repoFolder}/{$repoClass}");

        if (!file_exists($fileName)) {
            $this->makeDir($folderPath);

            $serviceTemplate = file_get_contents(resource_path("stubs/Repository.stub"));
            $serviceTemplate = str_replace(['{{Name}}'], [$name], $serviceTemplate);
            file_put_contents($fileName, $serviceTemplate);

            return true;
        } else {
            echo "WARNING : Services is existed\n";

            return false;
        }
    }

    protected function makeModel($name)
    {
        $modelFolder = $name;
        $modelClass = "{$name}Model.php";
        $folderPath = app_path("/Entities/Models/{$modelFolder}");
        $fileName = app_path("/Entities/Models/{$modelFolder}/{$modelClass}");

        if (!file_exists($fileName)) {
            $this->makeDir($folderPath);

            $serviceTemplate = file_get_contents(resource_path("stubs/Model.stub"));
            $serviceTemplate = str_replace(['{{Name}}'], [$name], $serviceTemplate);
            file_put_contents($fileName, $serviceTemplate);

            return true;
        } else {
            echo "WARNING : Services is existed\n";

            return false;
        }
    }

    protected function makeDir($folderPath)
    {
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
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
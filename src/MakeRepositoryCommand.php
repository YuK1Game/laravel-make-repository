<?php
namespace YuK1\LaravelMakeRepository;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    protected $name = 'make:repository';

    protected $description = 'Create a new repository';

    protected $type = 'Repository';

    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    protected function getPath($name)
    {
        $nameInput = $this->getNameInput();
        $nameBase = $this->getBaseName($name);
        return "app/Repositories/$nameBase/$nameInput.php";
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Repositories';
    }

    protected function buildClass($name)
    {
        $replaces = [
            'DummyBaseName' => $this->getBaseName($name),
        ];
        return str_replace(array_keys($replaces), array_values($replaces), parent::buildClass($name));     
    }

    public function handle() {
        $result = parent::handle();
        $baseName = str_replace('Repository', '', $this->getNameInput());
        $this->call('make:model', [
            'name' => 'App\\Models\\' . $baseName,
        ]);
        return $result;
    }

    private function getBaseName($name) {
        if (preg_match('/^.*\\\\(.*?)Repository$/', $name, $matches) === 1) {
            return $matches[1];
        }
        throw new \Exception('Invalid repository name.');  
    }
}
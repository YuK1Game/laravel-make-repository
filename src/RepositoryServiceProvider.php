<?php
namespace YuK1\LaravelMakeRepository;

use Illuminate\Support\ServiceProvider;
use YuK1\LaravelMakeRepository\MakeRepositoryCommand;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register() {
        $this->commands(MakeRepositoryCommand::class);
    }
}
<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Database\Console\Migrations\MigrateMakeCommand as Command;
use Illuminate\Support\Composer;

class MigrateMakeCommand extends Command
{
    /**
     * Create a new migration install command instance.
     *
     * @param \Illuminate\Database\Migrations\MigrationCreator $creator
     * @param \Illuminate\Support\Composer                     $composer
     */
    public function __construct(MigrationCreator $creator, Composer $composer)
    {
        parent::__construct($creator, $composer);
    }
}

<?php

namespace App\Console\Commands\Migrations;

use NormanHuth\HelpersLaravel\App\Console\Commands\Development\PivotMigrateMakeCommand as Command;

class PivotMigrateMakeCommand extends Command
{
    /**
     * @return string
     */
    protected function getFilename(): string
    {
        return getDatePrefix() . '_create_' . $this->table . '_pivot_table';
    }
}

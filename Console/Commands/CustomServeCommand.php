<?php

namespace App\Console\Commands;

use Illuminate\Support\Env;
use Illuminate\Foundation\Console\ServeCommand;
use Symfony\Component\Console\Input\InputOption;

class CustomServeCommand extends ServeCommand
{
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on', Env::get('REF_SERVER_PREFIX') . Env::get('REF_SERVER_HOST')],
            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on', Env::get('REF_SERVER_PORT')],
            ['tries', null, InputOption::VALUE_OPTIONAL, 'The max number of ports to attempt to serve from', 10],
            ['no-reload', null, InputOption::VALUE_NONE, 'Do not reload the development server on .env file changes'],
        ];
    }
}

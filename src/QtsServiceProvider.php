<?php 

namespace QuataInvestimentos;

use Illuminate\Support\ServiceProvider;
use Courier\Console\Commands\InstallCommand;
use Courier\Console\Commands\NetworkCommand;

class QtsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->commands([
            Console\Commands\CustomServeCommand::class
        ]);
        
    }

}
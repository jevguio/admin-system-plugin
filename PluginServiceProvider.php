<?php

namespace plugins\adminsystem;

use Illuminate\Support\ServiceProvider;
use App\PluginHook;

class PluginServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $jsonPath = __DIR__ . '/plugin.json';

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);

            PluginHook::registerPlugin(
                $data['title'] ?? 'Unknown',
                $data['name'] ?? 'Unknown',
                $data['version'] ?? '0.0.0',
                $data['description'] ?? '',
                $data['gitUrl'] ?? ''
            );


            $this->loadViewsFrom(__DIR__ . '/resources/view', 'view');

            // Register routes
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
            PluginHook::addTopMenu($data['title'], 'admin.plugin', ['gitUrl' => $data['gitUrl']]);
        }
    }

}

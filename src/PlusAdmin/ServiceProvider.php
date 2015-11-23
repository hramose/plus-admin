<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

    public function register()
    {
        $this->app->singleton('plus-admin', function($app) {
            return new Service($app);
        });
    }

    public function boot()
    {
        $service = $this->app->make('plus-admin');

        event('plus-admin.setup:before', [$service]);
        $service->setup();
        event('plus-admin.setup:after', [$service]);
    }

}
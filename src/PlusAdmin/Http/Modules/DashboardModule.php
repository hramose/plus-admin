<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin\Http\Modules;

use Illuminate\Routing\Router;
use PlusAdmin\Module\Module;

class DashboardModule extends Module {

    public function boot(Router $router)
    {
        $router->get('/', function() {
            return ($this->name());
        });
    }
}
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

class AccessModule extends Module {

    public function boot(Router $router)
    {
        // 注册路由
//        $router->group([], function() use($router) {
//           $router->resource('login');
//        });
        // 注册菜单
        // ui.menu.load;
    }

}
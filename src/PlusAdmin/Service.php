<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin;

use PlusAdmin\Module\ModuleManager;
use PlusAdmin\Plugin\PluginManager;

class Service extends Support\Service {

    /**
     * @var \PlusAdmin\Module\ModuleManager
     */
    protected $moduleManager;

    /**
     * @var \PlusAdmin\Plugin\PluginManager
     */
    protected $pluginManager;

    /**
     *
     */
    protected function register()
    {
        $this->moduleManager= new ModuleManager($this->app);
        $this->pluginManager = new PluginManager($this->app);
    }

    /**
     *
     */
    public function boot()
    {
        event('plus-admin.module.setup:before', [$this, $this->moduleManager]);
        $this->moduleManager->setup();
        event('plus-admin.module.setup:after', [$this, $this->moduleManager]);

        event('plus-admin.plugin.setup:before', [$this, $this->pluginManager]);
        $this->pluginManager->setup();
        event('plus-admin.plugin.setup:after', [$this, $this->pluginManager]);
    }

    /**
     * @return \PlusAdmin\Module\ModuleManager
     */
    public function module()
    {
        return $this->moduleManager;
    }

    /**
     * @return \PlusAdmin\Plugin\PluginManager
     */
    public function plugin()
    {
        return $this->pluginManager;
    }

}
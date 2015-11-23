<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin\Module;

use PlusAdmin\Support\Service;

class ModuleManager extends Service {

    const DISABLE_SYSTEM = 0;

    const DISABLE_USER = 1;

    protected $modules = [];

    protected $disabledNames = [];

    protected function register()
    {
        foreach (config('plus-admin.disable_modules', []) as $name) {
            $this->disabledNames[$name] = self::DISABLE_SYSTEM;
        }

        foreach (config('plus-admin.modules', []) as  $className) {
            if ( ! is_subclass_of($className, __NAMESPACE__ . '\\ModuleInterface'))
                throw new Exception($className);

            /** @var \PlusAdmin\Module\ModuleInterface $module */
            $module = new $className($this->app);
            $this->modules[$module->name()] = $module;
        }
    }

    public function boot()
    {
        $enables = $this->enabledNames();
        foreach ($this->modules as $module) {
            /** @var \PlusAdmin\Module\ModuleInterface $module */
            if (in_array($module->name(), $enables))
                $module->setup();
        }
    }

    /**
     * @param $name
     * @return \PlusAdmin\Module\ModuleInterface
     */
    public function get($name)
    {
        return $this->modules[$name];
    }

    public function activeNames()
    {
        $names = [];

        foreach ($this->modules as $name => $module) {
            /** @var \PlusAdmin\Module\ModuleInterface $module */
            if ($module->active())
                $names[] = $name;
        }

        return $names;
    }

    public function enabledNames()
    {
        return array_diff($this->names(), $this->disabledNames());
    }

    public function disabledNames()
    {
        return array_keys($this->disabledNames);
    }

    public function names()
    {
        return array_keys($this->modules);
    }

    public function enable($name)
    {
        if ( ! array_search($name, $this->names()))
            throw new Exception('');

        if ( ! array_search($name, $this->disabledNames())) {
            $module = $this->get($name);
            if ( ! $module->enabled())
                $module->setup();

            return $module->enabled();
        } else if (self::DISABLE_SYSTEM == $this->disabledNames[$name]) {
            return false;
        }

        $this->disabledNames[$name] = self::DISABLE_USER;

        $module = $this->get($name);
        if ($module->enabled())
            $module->shutdown();

        return ! $module->enabled();
    }

    public function disable($name)
    {
        if ( ! array_search($name, $this->names()))
            throw new Exception('');

        if ( ! array_search($name, $this->disabledNames()))
            return true;

        $this->disabledNames[$name] = self::DISABLE_USER;

        $module = $this->get($name);
        if ($module->enabled())
            $module->shutdown();

        return ! $module->enabled();
    }

    public function isActive($name)
    {
        return $this->modules[$name]->isActive();
    }

}
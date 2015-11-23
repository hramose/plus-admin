<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin\Module;

use PlusAdmin\Support\Service;

abstract class Module extends Service implements ModuleInterface {

    /**
     * @var string
     */
    protected $name;


    protected function register()
    {
        // TODO: Implement register() method.
    }

    public function active()
    {
        return ! $this->isHalted();
    }

    public function name()
    {
        if (null === $this->name) {
            if ('Module' == substr(($name = class_basename(static::class)), -6))
                $name = substr($name, 0, -6);
            $this->name = snake_case($name, '-');
        }

        return $this->name;
    }

}
<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin\Module;

interface ModuleInterface {

    /**
     * @return bool
     */
    public function active();

    /**
     * @return string
     */
    public function name();

    /**
     * @return void
     */
    public function setup();

    /**
     * @return void
     */
    public function shutdown();

}
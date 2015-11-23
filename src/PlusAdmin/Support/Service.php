<?php
/**
 * plus-admin
 *
 * @author  Panlatent<panlatent@gmail.com>
 * @license http://opensource.org/licenses/MIT
 */

namespace PlusAdmin\Support;

use Illuminate\Contracts\Foundation\Application;

abstract class Service {

    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * @var bool
     */
    protected $registered = false;

    /**
     * @var bool
     */
    protected $setupCompleted = false;

    /**
     * @var bool
     */
    protected $halted = true;

    /**
     * Service constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    final public function __construct(Application $app)
    {
        $this->app = $app;
        $this->register();
        $this->registered = true;
    }

    /**
     * @return void
     */
    abstract protected function register();

    /**
     *
     */
    final public function setup()
    {
        if (method_exists($this, 'boot'))
            $this->app->call([$this, 'boot']);

        $this->setupCompleted = true;
        $this->halted = false;
    }

    /**
     *
     */
    final public function shutdown()
    {
        $this->halted = true;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function app()
    {
        return $this->app;
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return $this->registered;
    }

    /**
     * @return bool
     */
    public function isSetupCompleted()
    {
        return $this->setupCompleted;
    }

    /**
     * @return bool
     */
    public function isHalted()
    {
        return $this->halted;
    }

}
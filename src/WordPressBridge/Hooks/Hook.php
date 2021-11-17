<?php 

namespace SlackApprove\WordPressBridge\Hooks;

abstract class Hook {

    protected $isRegistered = false;

    /**
     * Constructor, provide action and callable
     *
     * @param string $action
     * @param Callable $callable
     */
    public function __construct(protected string $action, protected $callable) {
        is_callable($callable) || throw new \InvalidArgumentException('Argument #2 must be callable');

        $this->action = $action;
        $this->callable = $callable;
    }

    /**
     * isRegistered
     *
     * @return Bool
     */
    public function isRegistered(): Bool {
        return $this->isRegistered;
    }

    /**
     * Register a hook using WordPress function
     *
     * @return void
     */
    abstract public function register(): Hook;

    /**
     * Remove a hook from WordPress
     *
     * @return void
     */
    abstract public function unregister(): Hook;
}
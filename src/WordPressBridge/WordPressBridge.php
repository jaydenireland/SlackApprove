<?php
namespace SlackApprove\WordPressBridge;

use SlackApprove\WordPressBridge\Hooks\{Filter, Action};
use SlackApprove\WordPressBridge\Model\Posts;

class WordPressBridge {

    /**
     * Posts Model
     *
     * @var Posts
     */
    public $Posts;

    /**
     * Construct bridge to wordpress api to make it OOP
     *
     * @param string $namespace - Namespace to prefix routes with
     */
    public function __construct(private string $namespace) {
        $this->Posts = new Posts;
        $this->namespace = $namespace;
    }

    /**
     * Get namespace
     *
     * @return string
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * Add WordPress Action
     * 
     * @param string $action
     * @param Callable $callable
     * 
     * @return Action
     */
    public function addAction(string $action, Callable $callable): Action {
        $action = new Action($action, $callable);
        $action->register();

        return $action;
    }

    /**
     * Add WordPress Filter
     * 
     * @param string $action
     * @param Callable $callable
     * 
     * @return Filter
     */
    public function addFilter(string $action, Callable $callable): Filter {
        $filter = new Filter($action, $callable);
        $filter->register();

        return $filter;
    }

    /**
     * Add API Route
     *
     * @param string $namespace
     * @param string $path
     * @param string $methods
     * @param Callable $callback
     * @return Action
     */
    public function addRoute(string $path, string $methods, Callable $callback, Callable $permission_callback) {
        return $this->addAction('rest_api_init', function() use ($path, $methods, $callback, $permission_callback) {
            register_rest_route($this->namespace, $path, compact('methods', 'callback', 'permission_callback'));
        });
    }

}
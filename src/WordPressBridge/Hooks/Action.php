<?php

namespace SlackApprove\WordPressBridge\Hooks;

class Action extends Hook {

    /**
     * @inheritDoc
     */
    public function register(): Hook {
        $this->registered = true;
        add_action($this->action, $this->callable);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unregister() : Hook {
        $this->registered = false;
        remove_action($this->action, $this->callable);
        
        return $this;
    }
}
<?php

namespace SlackApprove\WordPressBridge\Hooks;

class Filter extends Hook {

    /**
     * @inheritDoc
     */
    public function register(): Hook {
        $this->registered = true;
        add_filter($this->action, $this->callable);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function unregister() : Hook {
        $this->registered = false;
        add_filter($this->action, $this->callable);
        
        return $this;
    }
}
<?php

namespace Jenky\LaravelMoney;

use Illuminate\Support\Traits\Macroable;

class Factory
{
    use Macroable {
        __call as macroCall;
    }

    /**
     * Dynamically create money instance.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->forwardCallTo($this->channel(), $method, $parameters);
    }
}

<?php

namespace Jenky\LaravelMoney;

use Brick\Money\Money as BaseMoney;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;

class Money implements Arrayable, Jsonable, JsonSerializable, Renderable
{
    use ForwardsCalls, Macroable {
        __call as macroCall;
    }

    protected $money;

    public function __construct(BaseMoney $money)
    {
        $this->money = $money;
    }

    public function money(): BaseMoney
    {
        return $this->money;
    }

    public function toMoney($money): BaseMoney
    {
        if ($money instanceof BaseMoney) {
            return $money;
        }

        return $this->money;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        //
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Json serialize.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        //
    }

    /**
     * Dynamically call the money instance.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return $this->forwardCallTo($this->money, $method, $parameters);
    }
}

<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Renderable;

interface Money extends Arrayable, Jsonable, JsonSerializable, Renderable
{
    //
}

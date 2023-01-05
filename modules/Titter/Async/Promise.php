<?php
namespace Titter\Async;

// Hack for IDE hover behaviour.
if(false){class Promise extends \YukisCoffee\CoffeeRequest\Promise {}}

// We want a true copy such that:
// (new Titter\Async\Promise()) instanceof YukisCoffee\CoffeeRequest\Promise
// so a class alias is preferred here.
class_alias("YukisCoffee\\CoffeeRequest\\Promise", "Titter\\Async\\Promise");
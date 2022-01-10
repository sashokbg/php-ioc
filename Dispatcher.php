<?php

class Dispatcher
{
    function __construct(LoginController $controller)
    {
        echo "Creating a dispatcher <br>";
    }

    function dispatch($url) {
        $container = Container::get();

        $myController = $container->getInstance(LoginController::class);
        echo "";
    }
}

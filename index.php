<?php
include "BusinessService.php";
include "Container.php";
include "Dispatcher.php";

echo "Starting app <br>";

$container = Container::get();

try {
    //$bs = new BusinessService();
    //$container->registerInstance($bs);
    $container->register(Dispatcher::class);
    //$container->register(BusinessService::class);
    //$container->register(LoginController::class);
    $container->debug();

    $dispatcher = $container->getInstance(Dispatcher::class);

    $url = "http://test/uri";
    $dispatcher->dispatch($url);
} catch (ReflectionException $e) {
    echo "An error $e";
}

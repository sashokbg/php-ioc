<?php
include "BusinessService.php";
include "Container.php";
include "Dispatcher.php";

echo "Starting app <br>";

$container = new Container();

try {
    $bs = new BusinessService();
    $container->registerInstance($bs);
    $container->register(Dispatcher::class);
    //$container->register(BusinessService::class);
    //$container->register(LoginController::class);
    $container->debug();
} catch (ReflectionException $e) {
    echo "An error $e";
}

<?php

class Container
{

    private $instances = array();

    public function registerInstance($instance)
    {
       $this->instances[get_class($instance)] = $instance;
    }

    /**
     * @throws ReflectionException
     */
    public function register($className)
    {
        if (array_key_exists($className, $this->instances)) {
            return;
        }

        $this->autoloader($className);

        $reflectedClass = new ReflectionClass($className);
        $constructor = $reflectedClass->getConstructor();

        if ($constructor == null || sizeof($constructor->getParameters()) == 0) {
            $this->instances[$className] = new $className;
        } else {
            $arguments = array();

            for ($i = 0; $i < sizeof($constructor->getParameters()); $i++) {
                $param = $constructor->getParameters()[$i]->getType()->getName();
                $this->register($param);
                $arguments[] = $this->getInstance($param);
            }

            $newInstance = $reflectedClass->newInstanceArgs($arguments);
            echo "* Auto creating $className <br>";
            $this->instances[$className] = $newInstance;
        }
    }

    function getInstance($className)
    {
        return $this->instances[$className];
    }

    function autoloader($class)
    {
        include_once $class . '.php';
    }

    public function debug()
    {
        var_dump($this->instances);
    }
}


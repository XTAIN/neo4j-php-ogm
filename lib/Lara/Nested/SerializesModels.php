<?php

namespace Hedera\Lara\Nested;

trait SerializesModels
{

    public function __serialize(): array
    {
        $values = [];

        $properties = (new \ReflectionClass($this))->getProperties();

        $class = get_class($this);

        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $name = $property->getName();

//            if ($property->isPrivate()) {
//                $name = "\0{$class}\0{$name}";
//            } elseif ($property->isProtected()) {
//                $name = "\0*\0{$name}";
//            }

            $property->setAccessible(true);

            $values[$name] = $property->getValue($this);
        }

        return $values;
    }

    public function __unserialize(array $values): void
    {
        $properties = (new \ReflectionClass($this))->getProperties();

        $class = get_class($this);

        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $name = $property->getName();

//            if ($property->isPrivate()) {
//                $name = "\0{$class}\0{$name}";
//            } elseif ($property->isProtected()) {
//                $name = "\0*\0{$name}";
//            }

            if (! array_key_exists($name, $values)) {
                continue;
            }

            $property->setAccessible(true);

            $property->setValue(
                $this, $property->getValue()
            );
        }

//        return $values;
    }
}

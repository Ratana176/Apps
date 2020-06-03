<?php

namespace App\Core;

class Controller
{
    
    public static function getObjectProperties($object, $isObject = false)
    {
        try {
            $default_object = new stdClass();
            $default_arrays = [];

            $_object = new ReflectionClass($object);
            $is_public = $_object->getProperties(ReflectionProperty::IS_PUBLIC);
            $is_static = $_object->getProperties(ReflectionProperty::IS_STATIC);
            $filter = array_diff($is_public, $is_static);
            foreach ($filter as $property)
            {
                $name = $property->name;
                if ($property->class == $_object->name)
                {
                    if ($isObject)
                        $default_object->$name = $object->$name;
                    else
                        $default_arrays[$name] = $object->$name;
                }
            }
            return $isObject? $default_object : $default_arrays;
        } catch (ReflectionException $e) {
            return null;
        }
    }
}
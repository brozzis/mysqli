<?php

class ArrayOfColorModel implements ArrayAccess, Iterator, Countable {
    private $container = array();

    public function __construct() {
    }

    public function offsetSet($offset,$value) {
         if ($value instanceof ColorModel){
            if ($offset == "") {
                $this->container[] = $value;
            }else {
                $this->container[$offset] = $value;
            }
        } else {
            throw new Exception("Value have to be a instance of the Model ColorModel");
        }
    }

    public function offsetExists($offset) {
     return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function rewind() {
        reset($this->container);
    }

    public function current() {
        return current($this->container);
    }

    public function key() {
        return key($this->container);
    }

    public function next() {
        return next($this->container);
    }

    public function valid() {
        return $this->current() !== false;
    }   

    public function count() {
     return count($this->container);
    }

}

?>

Now you can using it like any other array.

<?php
   
   $array = new ArrayOfColorModel();
   foreach ($array as $model) {
        var_export($model);
   }

   // OR

   for($i=0;$i<count($array);$i++){
        var_export($array[$i]);
   }

?>
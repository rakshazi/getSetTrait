<?php

namespace Rakshazi;

/**
 * Dynamic getter/setter library for PHP 5.4+.
 *
 * Changelog:
 * Current realization - rakshazi/get-set-trait
 * First realization - rakshazi/get-set-go-improved
 * Idea - usmanhalalit/get-set-go
 *
 * @see https://github.com/rakshazi/GetSetTrait/blob/master/README.md
 */
trait GetSetTrait
{
    /**
     * Name of data property.
     *
     * @see $this::setDataProperty()
     *
     * @var null|string
     */
    private $_data_property = null;

    /**
     * Call method or getter/setter for property.
     *
     * @param string $method
     * @param mixed  $data
     *
     * @return mixed Data from object property
     *
     * @throws \Exception if method not implemented in class
     */
    public function __call($method, $params)
    {
        $parts = preg_split('/([A-Z][^A-Z]*)/', $method, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $type = array_shift($parts);

        if ($type == 'get' || $type == 'set') {
            $property = strtolower(implode('_', $parts));
            $params = (isset($params[0])) ? [$property, $params[0]] : [$property];

            return call_user_func_array([$this, $type.'Data'], $params);
        }
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $params);
        }

        throw new \Exception('Method "'.$method.'" not implemented.');
    }

    /**
     * Get property data, eg getData('post_id').
     *
     * @param string $property
     *
     * @return mixed
     */
    public function getData($property, $default = null)
    {
        if ($this->_data_property && isset($this->{$this->_data_property}[$property])) {
            return $this->{$this->_data_property}[$property];
        }

        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return $default;
    }

    /**
     * Set property data, eg getData('post_id',1).
     *
     * @param string $property
     * @param mixed  $data
     *
     * @return $this
     */
    public function setData($property, $data = null)
    {
        if ($this->_data_property) {
            $this->{$this->_data_property}[$property] = $data;
        } else {
            $this->$property = $data;
        }

        return $this;
    }

    /**
     * If you want use getter and setter only for data array
     * you can set property name with that function.
     *
     * @param string $property
     *
     * @return $this
     */
    public function setDataProperty($property)
    {
        $this->_data_property = $property;
        $this->$property = [];

        return $this;
    }
}

<?php
namespace Rakshazi;

/**
 * Dynamic getter/setter library for PHP 5.4+
 *
 * Changelog:
 * Current realization - rakshazi/get-set-trait
 * First realization - rakshazi/get-set-go-improved
 * Idea - usmanhalalit/get-set-go
 *
 * @link https://github.com/rakshazi/GetSetTrait/blob/master/README.md
 */
trait GetSetTrait
{
    /**
     * Call method or getter/setter for property
     * @param string $method
     * @param mixed $data
     * @return mixed Data from object property
     */
    public function __call($method = null, $params = array())
    {
        $parts = preg_split('/([A-Z][^A-Z]*)/', $method, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $type = array_shift($parts);

        if ($type == 'get' || $type = 'set') {
            $property = strtolower(implode('_', $parts));
            $params = (isset($params[0])) ? array($property, $params[0]) : array($property);
            return call_user_func_array(array($this, $type . 'Data'), $params);
        }

        return call_user_func_array(array($this, $method), $params);
    }

    /**
     * Get property data, eg getData('post_id')
     * @param string $property
     * @return $this
     */
    public function getData($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    /**
     * Set property data, eg getData('post_id',1)
     * @param string $property
     * @param mixed $data
     * @return $this
     */
    public function setData($property, $data = null)
    {
        $this->$property = $data;
    }
}

<?php

/**
 * Class QueryString
 */
class QueryString {

    /**
     * @var
     */
    private $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @param string $url
     * @param array $data
     * @return string
     */
    public function build($url = '', $data = [])
    {
        return $url.'?'.$this->append($data);
    }

    /**
     * @param array $data
     * @return string
     */
    public function append($data = [])
    {
        foreach($data as $key => $value)
            $this->data[$key] = $value;

        $qs = [];

        foreach($this->data as $key => $value)
            $qs[] = urlencode($key).'='.urlencode($value);

        return implode('&', $qs);
    }
}
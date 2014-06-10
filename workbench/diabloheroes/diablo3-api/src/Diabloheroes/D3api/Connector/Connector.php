<?php
/**
 * @author Luuk Holleman
 * @date: 4/10/14 7:45 PM
 * @package Diabloheroes\D3api\Connector
 */

namespace Diabloheroes\D3api\Connector;

class Connector{
    protected $curl;

    public $cache = false;

    public $cachingDir;

    public function __construct(){
        $this->curl = curl_init();
    }

    public function request($url){
        if($this->cache == true)
        {
            $md5 = md5($url);

            $dir = $this->cachingDir.'/'.substr($md5, 0, 2).'/';

            if(!is_dir($dir))
                mkdir($dir);

            if(file_exists($dir.$md5))
                return file_get_contents($dir.$md5);
        }


        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($this->curl);

        if($this->cache == true)
            file_put_contents($dir.$md5, $data);

        return $data;
    }
} 
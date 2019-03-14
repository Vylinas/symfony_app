<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CurlService extends Controller
{
    private $ch;

    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return $this;
    }

    public function setOpt()
    {
        
        
    }

    public function send()
    {
        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return $result;
    
    }

}
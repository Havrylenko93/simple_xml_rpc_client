<?php
namespace rpc;

class SimpleXmlRpcClient
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function call()
    {
        ini_set("display_error", 1); // do not do like this
        error_reporting(E_ALL);

        $params = func_get_args();
        $method = array_shift($params);

        $post = xmlrpc_encode_request($method, $params);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_USERPWD, 'login' . ':' . 'password');
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        return $response;
    }
}

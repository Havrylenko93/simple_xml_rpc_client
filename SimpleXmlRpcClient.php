<?php

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

        curl_setopt($ch, CURLOPT_USERPWD, 'iceshop' . ':' . '1C3SH#_#P');
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        return $response;
    }
}

$orderDataForCreate['orderData'] = [
    'customer_name' => 'UnboxCustomer',
    'customers_parent_id' => 0,
    'customers_ip_address' => '94.227.109.26',
    'customers_name' => 'Hoofdadres',
    'customers_gender' => 'm',
    'customers_company' => 'Iceshop'
];

$client = new SimpleXmlRpcClient("http://arc.batavi.org/api/api.php");
$response = $client->call('batavi.createOrder', $orderDataForCreate);

echo "<pre>";
var_dump(xmlrpc_decode($response));

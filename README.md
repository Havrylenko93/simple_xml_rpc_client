# How to use

1. Example
```$orderDataForCreate['orderData'] = [
    'customer_name' => 'UnboxCustomer',
    'customers_parent_id' => 0,
    'customers_ip_address' => '94.227.109.26',
    'customers_name' => 'Hoofdadres',
    'customers_gender' => 'm',
    'customers_company' => 'company'
];

$client = new SimpleXmlRpcClient("http://arc.batavi.org/api/api.php");
$response = $client->call('batavi.createOrder', $orderDataForCreate);

echo "<pre>";
var_dump(xmlrpc_decode($response));```
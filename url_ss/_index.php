<?php
require_once('vendor/autoload.php');
ini_set('display_errors', 'On');

use JonnyW\PhantomJs\Client;

$client = Client::getInstance();
//$client->getEngine()->setPath('/bin/phantomjs');


$request = $client->getMessageFactory()->createCaptureRequest('https://google.com/', 'GET');
$response = $client->getMessageFactory()->createResponse();

if(!file_exists('ss_file')) {
    mkdir('ss_file');
}
$file = 'ss_file/ss.jpg';
$request->setOutputFile($file);

$client->send($request, $response);

if($response->getStatus() === 200) {
    echo $response->getContent();
    echo '処理終わり';
}
?>

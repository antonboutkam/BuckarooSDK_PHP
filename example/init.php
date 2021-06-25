<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require(__DIR__ . '/../../../autoload.php');

use Buckaroo\SDK\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$websiteKey = "PUT_YOUR_WEBSITE_KEY_HERE";
$secretKey = "PUT_YOUR_SECRET_KEY_HERE";
$mode = Client::MODE_TEST;

$currencyCode = 'EUR';

$baseUrl = 'https://example.com/';
$returnURL = $baseUrl . 'index.php?status=return';
$returnURLCancel = $baseUrl . 'index.php?status=returnCancel';
$pushURL =  $baseUrl . 'index.php?status=push';

$logger = new Logger('buckaroo-sdk');
$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));

$client = new Client(null, null, $logger);
$client->setWebsiteKey($websiteKey);
$client->setSecretKey($secretKey);
$client->setMode($mode);

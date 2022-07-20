<?php

require('../bootstrap.php');

use Buckaroo\Buckaroo;

$buckaroo = new Buckaroo($_ENV['BPE_WEBSITE_KEY'], $_ENV['BPE_SECRET_KEY']);

//Also accepts json
//Pay
$response = $buckaroo->payment("requesttopay")->pay([
    'amountDebit'       => 3.5,
    'invoice'           => uniqid(),
    'serviceParameters' => [
        'customer'      => [
            'name'          => 'J. De Tester'
        ]
    ]
]);

$response = $this->buckaroo->payment('requesttopay')->refund([
    'amountCredit' => 10,
    'invoice'       => 'testinvoice 123',
    'originalTransactionKey' => '2D04704995B74D679AACC59F87XXXXXX'
]);
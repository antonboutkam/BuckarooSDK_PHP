<?php

namespace Buckaroo\PaymentMethods;

use Buckaroo\Model\Adapters\ServiceParametersKeys\TinkaArticleAdapter;
use Buckaroo\Model\Adapters\ServiceParametersKeys\TinkaCustomerAdapter;
use Buckaroo\Model\Article;
use Buckaroo\Model\Customer;
use Buckaroo\Model\ServiceList;
use Buckaroo\Services\ServiceListParameters\ArticleParameters;
use Buckaroo\Services\ServiceListParameters\DefaultParameters;
use Buckaroo\Services\ServiceListParameters\TinkaCustomerParameters;

class Tinka extends PaymentMethod
{
    protected string $paymentName = 'Tinka';

    public function setPayServiceList(array $serviceParameters = [])
    {
        $serviceList =  new ServiceList(
            $this->paymentName(),
            $this->serviceVersion(),
            'Pay'
        );

        $serviceList->appendParameter([
            [
                "Name"              => "PaymentMethod",
                "Value"             => $serviceParameters['paymentMethod'],
                "GroupType"         => "",
                "GroupID"           => ""
            ],
            [
                "Name"              => "DeliveryMethod",
                "Value"             => $serviceParameters['deliveryMethod'],
                "GroupType"         => "",
                "GroupID"           => ""
            ],
            [
                "Name"              => "DeliveryDate",
                "Value"             => $serviceParameters['deliveryDate'],
                "GroupType"         => "",
                "GroupID"           => ""
            ]
        ]);

        $parametersService = new ArticleParameters(new DefaultParameters($serviceList), array_map(function($article){
            return new TinkaArticleAdapter((new Article())->setProperties($article));
        }, $serviceParameters['articles'] ?? []));

        $parametersService = new TinkaCustomerParameters($parametersService, ['customer' => new TinkaCustomerAdapter((new Customer())->setProperties($serviceParameters['customer'] ?? []))]);
        $parametersService->data();

        $this->request->getServices()->pushServiceList($serviceList);

        return $this;
    }
}
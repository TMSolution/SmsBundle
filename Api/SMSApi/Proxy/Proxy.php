<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Proxy;

interface Proxy
{

    public function execute(\TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction $action);

    public function getProtocol();

    public function getHost();

    public function getPort();
}

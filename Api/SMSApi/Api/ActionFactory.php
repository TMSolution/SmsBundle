<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api;

/**
 * Class ActionFactory
 * @package TMSolution\SmsBundle\Api\SMSApi\Api
 */
abstract class ActionFactory
{

    /**
     * @var \TMSolution\SmsBundle\Api\SMSApi\Client
     */
    protected $client = null;

    /**
     * @var \TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy
     */
    protected $proxy = null;

    /**
     * @param null $proxy
     * @param null $client
     */
    public function __construct($proxy = null, $client = null)
    {

        if ($proxy instanceof \TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy) {
            $this->setProxy($proxy);
        } else {
            $this->setProxy(new \TMSolution\SmsBundle\Api\SMSApi\Proxy\Http\Native('https://ssl.TMSolution\SmsBundle\Api\SMSApi.pl/'));
        }

        if ($client instanceof \TMSolution\SmsBundle\Api\SMSApi\Client) {
            $this->setClient($client);
        }
    }

    /**
     * @param \TMSolution\SmsBundle\Api\SMSApi\Client $client
     * @return $this
     */
    public function setClient(\TMSolution\SmsBundle\Api\SMSApi\Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param \TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy $proxy
     * @return $this
     */
    public function setProxy(\TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy $proxy)
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * @return \TMSolution\SmsBundle\Api\SMSApi\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return \TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy
     */
    public function getProxy()
    {
        return $this->proxy;
    }

}

<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class SenderList
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender
 */
class SenderList extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\SendersResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\SendersResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&list=1";

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/sender.do", $query);
    }

}

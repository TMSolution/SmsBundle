<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class SenderDefault
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender
 */
class SenderDefault extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\RawResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\RawResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/sender.do", $query);
    }

    /**
     * Set name of default sender name.
     *
     * @param string $senderName sender name
     * @return $this
     */
    public function setSender($senderName)
    {
        $this->params["default"] = $senderName;
        return $this;
    }

}

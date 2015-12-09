<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class Add
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender
 */
class Add extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\CountableResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\CountableResponse($data);
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
     * Set new sender name.
     *
     * @param string $senderName sender name
     * @return $this
     */
    public function setName($senderName)
    {
        $this->params["add"] = $senderName;
        return $this;
    }

}

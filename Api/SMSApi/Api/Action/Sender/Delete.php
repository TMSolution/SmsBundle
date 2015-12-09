<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class Delete
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender
 */
class Delete extends AbstractAction
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
     * Set filter by sender name.
     *
     * @param $senderName string Sender name do delete
     * @return $this
     */
    public function filterBySenderName($senderName)
    {
        $this->params["delete"] = $senderName;
        return $this;
    }

    /**
     * @deprecated since v1.0.0
     */
    public function setSender($senderName)
    {
        return $this->filterBySenderName($senderName);
    }

}

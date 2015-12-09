<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sms;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Api\Response\CountableResponse;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class Delete
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sms
 *
 * @method CountableResponse execute()
 */
class Delete extends AbstractAction
{

    /**
     * @var int
     */
    private $id;

    /**
     * @param $data
     * @return CountableResponse
     */
    protected function response($data)
    {
        return new CountableResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&sch_del=" . $this->id;

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/sms.do", $query);
    }

    /**
     * Set ID of message to delete.
     *
     * This id was returned after sending message.
     *
     * @param $id
     * @return $this
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function filterById($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @deprecated since v1.0.0
     *
     * @param $id
     * @return $this
     */
    public function id($id)
    {
        return $this->filterById($id);
    }

}

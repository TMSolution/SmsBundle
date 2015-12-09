<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Mms;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Api\Response\StatusResponse;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class Get
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Mms
 *
 * @method StatusResponse execute()
 */
class Get extends AbstractAction
{

    /**
     * @var \ArrayObject
     */
    private $id;

    function __construct()
    {
        $this->id = new \ArrayObject();
    }

    /**
     * @param $data
     * @return StatusResponse
     */
    protected function response($data)
    {
        return new StatusResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&status=" . implode("|", $this->id->getArrayCopy());

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/mms.do", $query);
    }

    /**
     * Set ID of messages to check.
     *
     * This id was returned after sending message.
     *
     * @param $id
     * @return $this
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function filterById($id)
    {

        $this->id->append($id);
        return $this;
    }

    /**
     * Set IDs of messages to check.
     *
     * This id was returned after sending message.
     *
     * @param $ids
     * @return $this
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function filterByIds(array $ids)
    {

        $this->id->exchangeArray($ids);
        return $this;
    }

    /**
     * @deprecated since v1.0.0
     */
    public function ids($array)
    {
        return $this->filterByIds($array);
    }

    /**
     * @deprecated since v1.0.0
     */
    public function id($id)
    {
        return $this->filterById($id);
    }

}

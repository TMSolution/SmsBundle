<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class StatusResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class StatusResponse extends CountableResponse
{

    /**
     * @var \ArrayObject|MessageResponse[]
     */
    private $list;

    /**
     * @param $data
     */
    function __construct($data)
    {
        parent::__construct($data);

        $this->list = new \ArrayObject();

        if (isset($this->obj->list)) {
            foreach ($this->obj->list as $res) {
                $this->list->append(new MessageResponse($res->id, $res->points, $res->number, $res->status, $res->error, $res->idx));
            }
        }
    }

    /**
     * @return MessageResponse[]
     */
    public function getList()
    {
        return $this->list;
    }

}

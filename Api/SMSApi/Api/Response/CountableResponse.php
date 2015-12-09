<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class CountableResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class CountableResponse extends AbstractResponse
{

    /**
     * @var int
     */
    protected $count;

    /**
     * @param $data
     */
    function __construct($data)
    {
        parent::__construct($data);

        $this->count = isset($this->obj->count) ? $this->obj->count : 0;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

}

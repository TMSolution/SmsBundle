<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class GroupsResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class GroupsResponse extends CountableResponse
{

    /**
     * @var \ArrayObject
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
                $this->list->append(new GroupResponse($res));
            }
        }
    }

    /**
     * @return \ArrayObject}GroupResponse[]
     */
    public function getList()
    {
        return $this->list;
    }

}

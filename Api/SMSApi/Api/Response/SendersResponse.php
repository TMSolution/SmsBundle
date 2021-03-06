<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class SendersResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class SendersResponse extends AbstractResponse
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

        if (isset($this->obj)) {
            foreach ($this->obj as $res) {
                $this->list->append(new SenderResponse($res));
            }
        }
    }

    /**
     * @return SenderResponse[]|\ArrayObject
     */
    public function getList()
    {
        return $this->list;
    }

}

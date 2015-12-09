<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class RawResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class RawResponse implements Response
{

    /**
     * @var
     */
    private $text;

    /**
     * @param $data
     */
    function __construct($data)
    {

        $this->text = $data;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

}

<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class ContactDelete
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook
 */
class ContactDelete extends AbstractAction
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

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/phonebook.do", $query);
    }

    /**
     * Set contact phone number to delete.
     *
     * @param string|int $number phone number
     * @return $this
     */
    public function filterByPhoneNumber($number)
    {
        $this->params["delete_contact"] = $number;
        return $this;
    }

    /**
     * @deprecated since v1.0.0
     * @param string|int $number phone number
     * @return $this
     */
    public function setContact($number)
    {
        return $this->filterByPhoneNumber($number);
    }

}

<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\User;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class Get
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\User
 */
class Get extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\UserResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\UserResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/user.do", $query);
    }

    /**
     * @deprecated since v1.0.0
     * @param $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->params["get_user"] = $username;
        return $this;
    }

    /**
     * Set username to edit account.
     *
     * @param string $username username
     * @return $this
     */
    public function filterByUserName($username)
    {
        $this->params["get_user"] = $username;
        return $this;
    }

}

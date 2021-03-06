<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class GroupAdd
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook
 */
class GroupAdd extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\GroupResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\GroupResponse($data);
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
     * Set group name.
     *
     * @param string $groupName
     * @return $this
     */
    public function setName($groupName)
    {
        $this->params["add_group"] = $groupName;
        return $this;
    }

    /**
     * Set additional group description.
     *
     * @param string $info group description
     * @return $this
     */
    public function setInfo($info)
    {
        $this->params["info"] = $info;
        return $this;
    }

}

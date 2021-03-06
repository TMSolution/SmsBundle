<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class GroupGet
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\Phonebook
 */
class GroupGet extends AbstractAction
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
     * @deprecated since v1.0.0
     * @param $groupName
     * @return $this
     */
    public function setGroup($groupName)
    {
        return $this->filterByGroupName($groupName);
    }

    /**
     * Set group name to find.
     *
     * @param string $groupName group name
     * @return $this
     */
    public function filterByGroupName($groupName)
    {
        $this->params["get_group"] = $groupName;
        return $this;
    }

}

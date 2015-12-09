<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action\User;

use TMSolution\SmsBundle\Api\SMSApi\Api\Action\AbstractAction;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Uri;

/**
 * Class GetPoints
 *
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action\User
 *
 * @method \TMSolution\SmsBundle\Api\SMSApi\Api\Response\PointsResponse|null execute() execute()
 */
class GetPoints extends AbstractAction
{

    /**
     * @param $data
     * @return \TMSolution\SmsBundle\Api\SMSApi\Api\Response\PointsResponse
     */
    protected function response($data)
    {

        return new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\PointsResponse($data);
    }

    /**
     * @return Uri
     */
    public function uri()
    {

        $query = "";

        $query .= $this->paramsLoginToQuery();

        $query .= $this->paramsOther();

        $query .= "&credits=1";

        return new Uri($this->proxy->getProtocol(), $this->proxy->getHost(), $this->proxy->getPort(), "/api/user.do", $query);
    }

}

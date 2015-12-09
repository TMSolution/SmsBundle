<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Response;

/**
 * Class PointsResponse
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Response
 */
class PointsResponse extends AbstractResponse
{

    const className = __CLASS__;

    /**
     * Number of points available for user.
     *
     * @return number
     */
    public function getPoints()
    {
        return $this->obj->points;
    }

}

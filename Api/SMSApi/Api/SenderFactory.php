<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api;

/**
 * Class SenderFactory
 * @package TMSolution\SmsBundle\Api\SMSApi\Api
 */
class SenderFactory extends ActionFactory
{

    /**
     * @return Action\Sender\SenderList
     */
    public function actionList()
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender\SenderList();
        $action->client($this->client);
        $action->proxy($this->proxy);

        return $action;
    }

    /**
     * @param null $senderName
     * @return Action\Sender\Add
     */
    public function actionAdd($senderName = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender\Add();
        $action->client($this->client);
        $action->proxy($this->proxy);

        if (!empty($senderName)) {
            $action->setName($senderName);
        }

        return $action;
    }

    /**
     * @param null $senderName
     * @return Action\Sender\Delete
     */
    public function actionDelete($senderName = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender\Delete();
        $action->client($this->client);
        $action->proxy($this->proxy);

        if (!empty($senderName)) {
            $action->filterBySenderName($senderName);
        }

        return $action;
    }

    /**
     * @param null $senderName
     * @return Action\Sender\SenderDefault
     */
    public function actionSetDefault($senderName = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Sender\SenderDefault();
        $action->client($this->client);
        $action->proxy($this->proxy);

        if (!empty($senderName)) {
            $action->setSender($senderName);
        }

        return $action;
    }

}

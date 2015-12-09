<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api;

/**
 * Class MmsFactory
 * @package TMSolution\SmsBundle\Api\SMSApi\Api
 */
class MmsFactory extends ActionFactory
{

    /**
     * @return Action\Mms\Send
     */
    public function actionSend()
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Mms\Send();
        $action->client($this->client);
        $action->proxy($this->proxy);

        return $action;
    }

    /**
     * @param null $id
     * @return Action\Mms\Get
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function actionGet($id = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Mms\Get();
        $action->client($this->client);
        $action->proxy($this->proxy);

        if (!empty($id) && is_string($id)) {
            $action->filterById($id);
        } else if (!empty($id) && is_array($id)) {
            $action->filterByIds($id);
        }

        return $action;
    }

    /**
     * @param null $id
     * @return Action\Mms\Delete
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function actionDelete($id = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Mms\Delete();
        $action->client($this->client);
        $action->proxy($this->proxy);

        if (!empty($id) && is_string($id)) {
            $action->filterById($id);
        } else if (!empty($id) && is_array($id)) {
            $action->filterByIds($id);
        }

        return $action;
    }

}

<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api;

/**
 * Class VmsFactory
 * @package TMSolution\SmsBundle\Api\SMSApi\Api
 */
class VmsFactory extends ActionFactory
{

    /**
     * @return Action\Vms\Send
     */
    public function actionSend()
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Vms\Send();
        $action->client($this->client);
        $action->proxy($this->proxy);

        return $action;
    }

    /**
     * @param null $id
     * @return Action\Vms\Get
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function actionGet($id = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Vms\Get();
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
     * @return Action\Vms\Delete
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    public function actionDelete($id = null)
    {
        $action = new \TMSolution\SmsBundle\Api\SMSApi\Api\Action\Vms\Delete();
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

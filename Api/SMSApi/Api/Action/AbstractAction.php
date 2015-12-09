<?php

namespace TMSolution\SmsBundle\Api\SMSApi\Api\Action;

/**
 * Class AbstractAction
 * @package TMSolution\SmsBundle\Api\SMSApi\Api\Action
 */
abstract class AbstractAction
{

    /**
     * @var
     */
    protected $client;

    /**
     * @var
     */
    protected $proxy;

    /**
     * @var array
     */
    protected $params = array();

    /**
     * @var \ArrayObject
     */
    protected $to;

    /**
     * @var \ArrayObject
     */
    protected $idx;

    /**
     * @var
     */
    protected $group;

    /**
     * @var
     */
    protected $date;

    /**
     * @var
     */
    protected $encoding;

    /**
     *
     */
    function __construct()
    {
        $this->to = new \ArrayObject();
        $this->idx = new \ArrayObject();
    }

    /**
     * @return mixed
     */
    abstract public function uri();

    /**
     * @param $data
     * @return mixed
     */
    abstract protected function response($data);

    /**
     * @return null
     */
    public function file()
    {
        return null;
    }

    /**
     * @param \TMSolution\SmsBundle\Api\SMSApi\Client $client
     */
    public function client(\TMSolution\SmsBundle\Api\SMSApi\Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param \TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy $proxy
     */
    public function proxy(\TMSolution\SmsBundle\Api\SMSApi\Proxy\Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * @param $val
     * @return $this
     */
    public function setTest($val)
    {
        if ($val == true) {
            $this->params['test'] = 1;
        } else if ($val == false) {
            unset($this->params['test']);
        }

        return $this;
    }

    /**
     * @param $val
     * @return $this
     */
    protected function setJson($val)
    {
        if ($val == true) {
            $this->params['format'] = 'json';
        } else if ($val == false) {
            unset($this->params['format']);
        }

        return $this;
    }

    /**
     * @param string $skip
     * @return string
     */
    protected function paramsOther($skip = "")
    {

        $query = "";

        foreach ($this->params as $key => $val) {
            if ($key != $skip && $val != null) {
                $query .= '&' . $key . '=' . $val;
            }
        }

        return $query;
    }

    /**
     * @return string
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    protected function renderTo()
    {

        $sizeTo = $this->to->count();
        $sizeIdx = $this->idx->count();

        if ($sizeIdx > 0) {
            if (($sizeTo != $sizeIdx)) {
                throw new \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException("size idx is not equals to");
            } else {
                return $this->renderList($this->to, ',') . "&idx=" . $this->renderList($this->idx, '|');
            }
        }

        return $this->renderList($this->to, ',');
    }

    /**
     * @param \ArrayObject $values
     * @param $delimiter
     * @return string
     */
    private function renderList(\ArrayObject $values, $delimiter)
    {

        $query = "";
        $loop = 1;
        $size = $values->count();

        foreach ($values as $val) {
            $query .= $val;
            if ($loop < $size) {
                $query .= $delimiter;
            }

            $loop++;
        }

        return $query;
    }

    /**
     * @return string
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     */
    protected function paramsBasicToQuery()
    {

        $query = "";

        $query .= ($this->group != null) ? "&group=" . $this->group : "&to=" . $this->renderTo();

        $query .= ($this->date != null) ? "&date=" . $this->date : "";

        $query .= ( $this->encoding != null ) ? "&encoding=" . $this->encoding : "";

        return $query;
    }

    /**
     * @return string
     */
    protected function paramsLoginToQuery()
    {
        return "username=" . $this->client->getUsername() . "&password=" . $this->client->getPassword();
    }

    /**
     * @return mixed
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ClientException
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\HostException
     */
    public function execute()
    {
        try {
            $this->setJson(true);

            $data = $this->proxy->execute($this);

            $this->handleError($data);

            return $this->response($data);
        } catch (Exception $ex) {
            throw new \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException($ex->getMessage());
        }
    }

    /**
     * @param $data
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\ClientException
     * @throws \TMSolution\SmsBundle\Api\SMSApi\Exception\HostException
     */
    protected function handleError($data)
    {

        $error = new \TMSolution\SmsBundle\Api\SMSApi\Api\Response\ErrorResponse($data);

        if ($error->isError()) {
            if (\TMSolution\SmsBundle\Api\SMSApi\Exception\SmsapiException::isHostError($error->code)) {
                throw new \TMSolution\SmsBundle\Api\SMSApi\Exception\HostException($error->message, $error->code);
            }

            if (\TMSolution\SmsBundle\Api\SMSApi\Exception\SmsapiException::isClientError($error->code)) {
                throw new \TMSolution\SmsBundle\Api\SMSApi\Exception\ClientException($error->message, $error->code);
            } else {
                throw new \TMSolution\SmsBundle\Api\SMSApi\Exception\ActionException($error->message, $error->code);
            }
        }
    }

}

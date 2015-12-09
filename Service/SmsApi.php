<?php

namespace TMSolution\SmsBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TMSolution\SmsBundle\Api\SMSApi\Client as SMSApiClient;
use TMSolution\SmsBundle\Api\SMSApi\Api\SmsFactory;
use TMSolution\SmsBundle\Api\SMSApi\Proxy\Http\Native;


class SmsApi
{

    /**
     *
     * @type ContainerInterface
     */
    protected $container;
    protected $smsApiProcessor;
    protected $smsMessage;
    protected $apiUsername;
    protected $apiHashSecret;
    protected $apiUrl;
    protected $partnerAffiliateCode;

    /**
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->apiUsername = $this->getContainer()->getParameter('sms.smsapi.username');
        $this->apiHashSecret = $this->getContainer()->getParameter('sms.smsapi.secret_md5');
        $this->apiUrl = $this->getContainer()->getParameter('sms.smsapi.url');
        $this->partnerAffiliateCode = $this->getContainer()->getParameter('sms.smsapi.partner_affiliate_code');
    }

    protected function getContainer()
    {
        return $this->container;
    }

    protected function login()
    {


        $smsApiClient = new SMSApiClient($this->apiUsername);
        $smsApiClient->setPasswordHash($this->apiHashSecret);
        $smsApiServer = new Native($this->apiUrl);

        $this->smsApiProcessor = new SmsFactory($smsApiServer);
        $this->smsApiProcessor->setClient($smsApiClient);

        return $this->smsApiProcessor;
    }

    /*
     * phone            Numer odbiorcy w postaci 48xxxxxxxxx lub xxxxxxxxx
     * content          Treść wiadomości w UTF-8
     * senderName       Nazwa nadawcy - musi zostać najpierw dodana przez panel, wpisując ECO zostanie wysłana wiadomość ECO
     * ownIdentifier    Identyfikator nadany przez system wysyłający
     * flash            0 lub 1 - ustawienie parametru na 1 zamienia wiadomość sms w prezentującą się po przyjściu na ekranie, jednak nie zapisuje się w skrzynce odbiorczej.
     */

    public function sendMessage($phone, $content, $encoding='utf-8', $senderName = null, $ownIdentifier = null, $flash = 0)
    {
        if (!$this->smsApiProcessor) {
            $this->login();
        }

        try {

            if (!$senderName) {
                $senderName = 'ECO';
            }

            $this->smsMessage = $this->smsApiProcessor->actionSend();

            $this->smsMessage->setTo($phone);
            $this->smsMessage->setText($content);
            $this->smsMessage->setIDx($ownIdentifier);
            $this->smsMessage->setFlash($flash);
            $this->smsMessage->setSender($senderName);
            $this->smsMessage->setEncoding($encoding);
            if ($this->partnerAffiliateCode) {
                $this->smsMessage->setPartner($this->partnerAffiliateCode);
            }

            $response = $this->smsMessage->execute();

            foreach ($response->getList() as $status) {
                return $status;
            }
        } catch (\SMSApi\Exception\SmsapiException $e) {
            return false;
        }
    }

    /*
     * id           identyfikator wysłanej wiadomosci
     */

    public function checkMessageStatus($id)
    {
        if (!$this->smsApiProcessor) {
            $this->login();
        }

        $getMessage = $this->smsApiProcessor->actionGet($id);
        $response = $getMessage->execute();
        return $response;
    }

    /*
     * Przyjmuje requesta z żądania wywoływanego z SMSApi.pl
     * Nalezy zadbac o dostęp do interfejsu oraz zdefiniowac 
     * adres zwrotny w panelu SMSApi.
     * 
     * Uwaga! Po odbiorze wiadości należy zwrócić wartość "OK",
     * w przeciwnym wypadku SMSApi ponowi wywołanie !
     * 
     * MsgId            ID wysłanej wiadomości.
     *                  Parametr MsgId jest parametrem o zmiennej
     *                  długości, ale nie większej niż 32 znaki.
     * 
     * status           Kod stausu doręczenia. Lista w Dodatek nr 1
     *
     * status_name      Nazwa statusu doręczenia. Lista w Dodatek nr 1
     * 
     * idx              Opcjonalny parametr użytkownika wysłany z  SMS'em
     * 
     * donedate         Czas dostarczenia wiadomości w formacie unixtime
     * 
     * username         Nazwa użytkownika wysyłającego wiadomość
     * 
     * points*          Ilość punktów pobranych za wysyłkę wiadomości
     * 
     * to               Numer na jaki wysyłana była wiadomość
     *       
     */

    public function apiCallback($request)
    {
        $message = new \stdClass();
        $message->id->$request->get('MsgId');
        $message->from->$request->get('sms_from');
        $message->to->$request->get('sms_to');
        $message->date->$request->get('sms_date');
        $message->text->$request->get('sms_text');
        $message->userName->$request->get('username');

        return $message;
    }

}

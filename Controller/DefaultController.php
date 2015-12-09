<?php

namespace TMSolution\SmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function testAction()
    {
        /*
         * SMSAPI EXAMPLE
         * $smsService=$this->container->get('sms.smsapi');
         * $smsService->sendMessage('519058293', 'TO TEST', 'ECO');
         * $response=$smsService->checkMessageStatus('1449400402612737730');
         */

        /*
         * Stargate 2n exxample
         */
        $smsService=$this->container->get('gate.2n.api');
        $smsService->sendMessage('791602443', 'Testowy sms do wysylki');
        
        $ooo=hex2bin('001100098197612044F30000FF16D4F29CFEBEE741F3F61C447E83EEF9799EBD4E03');

dump($ooo);
    




        die('--STOP--');
    }

}

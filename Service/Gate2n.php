<?php

namespace TMSolution\SmsBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Gate2n
{

    /**
     *
     * @type ContainerInterface
     */
    protected $container;
    protected $gates2n;

    /**
     * 
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getContainer()
    {
        return $this->container;
    }

    protected function preparePDU($phone, $content)
    {
        $pduGenerator = $this->getContainer()->get('pdu.generator');
        $pdu = $pduGenerator->generatePDU($phone, $content);
        return $pdu;
    }

    protected function prepareChecksum($pdu)
    {
        $checksum='';
        return $checksum;
    }

    protected function getModule($gateNumber, $moduleNumber)
    {

        return '00';
    }

    protected function prepareSendCommand($phone, $content)
    {
        $pduObject = $this->preparePDU($phone, $content);
        /* 3 */
        $pdu = $pduObject['pdu'];
        /* 2 */
        $pduLength = $pduObject['cmgslen'];
        /* 1 */
        $module = $this->getModule(1, 1);
        /* 4 */
        $checksum = $this->prepareChecksum($pdu);

        $command = 'AT^SM=' . $module . ',' . $pduLength . ',' . $pdu . ',' . $checksum;
        return $command;
    }

    public function sendMessage($phone, $content)
    {

        $atCommand = $this->prepareSendCommand($phone, $content);
        
        $this->gates2n = $this->getContainer()->getParameter('sms.gates2n');
        
        dump( $this->gates2n);
        /*
         * SG login: Admin
          Password: **
          OK
          AT!G=A6
          OK
          AT^SM=00,33,001100098197612044F30000FF16D4F29CFEBEE741F3F61C447E83EEF9799EBD4E03,9B
         * smsout: 0,2,00
          W przypadku błędu wysyłki, brama zwróci komunikat smserr.
         */
    }

}

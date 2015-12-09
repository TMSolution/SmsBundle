<?php

/**
 * Copyright (c) 2014, TMSolution
 * All rights reserved.
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace TMSolution\SmsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Bundle\DoctrineBundle\Mapping\DisconnectedMetadataFactory;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

/**
 * send SMS.
 * @author Jacek Łoziński <jacek.lozinski@tmsolution.pl>
 */
class SmsApiSendCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this->setName('sms:smsapi:send')
                ->setDescription('Send SMS via SmsApi.pl')
                ->addArgument('phoneNumber', InputArgument::REQUIRED, 'Insert phone number xxxxxxxxx or 48xxxxxxxxxx')
                ->addArgument('message', InputArgument::REQUIRED, 'Insert text message');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $smsApiService = $this->getContainer()->get('sms.smsapi');

        $phoneNumber = $input->getArgument('phoneNumber');
        $message = $input->getArgument('message');

        if ($phoneNumber && $message) {
            try {
                $status=$smsApiService->sendMessage($phoneNumber, $message, 'windows-1250');
                $output->writeln("Message sended");
                
            } catch (\Exception $e) {
                $output->writeln("Message not send: ".$e->getMessage());
            }
        }
    }

}

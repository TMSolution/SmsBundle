<?php

namespace TMSolution\SmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SmsExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        $container->setParameter("sms.smsapi.url", $config["smsapi"]["url"]);
        $container->setParameter("sms.smsapi.username", $config["smsapi"]["username"]);
        $container->setParameter("sms.smsapi.secret_md5", $config["smsapi"]["secret_md5"]);
        $container->setParameter("sms.smsapi.partner_affiliate_code", $config["smsapi"]["partner_affiliate_code"]);
        
        $container->setParameter("sms.gates2n", $config["gates2n"]);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

}

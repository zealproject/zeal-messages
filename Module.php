<?php
/**
 * Zeal Messages
 *
 * @link      http://github.com/tfountain
 * @copyright Copyright (c) 2010-2013 Tim Fountain (http://tfountain.co.uk/)
 * @license   http://tfountain.co.uk/license New BSD License
 */

namespace ZealMessages;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'messages' => function ($helperPluginManager) {
                    $sm = $helperPluginManager->getServiceLocator();

                    $messagesPlugin = $sm->get('ControllerPluginManager')->get('messages');
                    $messages = $messagesPlugin->getMergedMessages();

                    $helper = new View\Helper\Messages($messages);

                    return $helper;
                }
            )
        );
    }
}

<?php

namespace ZealMessages\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Messages extends AbstractPlugin
{
    static protected $messages = array();

    public static function getMessages()
    {
        return self::$messages;
    }

    public function info($message)
    {
        if (!isset(self::$messages['info'])) {
            self::$messages['info'] = array();
        }

        self::$messages['info'][] = $message;
    }

    public function error($message)
    {
        if (!isset(self::$messages['error'])) {
            self::$messages['error'] = array();
        }

        self::$messages['error'][] = $message;
    }

    public function success($message)
    {
        if (!isset(self::$messages['success'])) {
            self::$messages['success'] = array();
        }

        self::$messages['success'][] = $message;
    }

    public function flashInfo($message)
    {

    }

    public function flashError($message)
    {

    }

    public function flashSuccess($message)
    {

    }
}

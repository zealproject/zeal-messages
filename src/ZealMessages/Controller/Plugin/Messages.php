<?php

namespace ZealMessages\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Session\Container as SessionContainer;

class Messages extends AbstractPlugin
{
    /**
     * Array for standard messages
     *
     * @var array
     */
    protected $messages = array();

    /**
     * Session container for flash messages
     *
     * @var SessionContainer
     */
    protected $sessionContainer;

    /**
     * @var boolean
     */
    protected $flashMessageAdded;


    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Returns an array containing both the standard messages
     * and any flash ones
     *
     * @return array
     */
    public function getMergedMessages()
    {
        $sessionContainer = $this->getSessionContainer();

        if (!isset($sessionContainer->messages) || !is_array($sessionContainer->messages)) {
            $sessionMessages = array();
        } else {
            $sessionMessages = $sessionContainer->messages;
        }

        return array_merge($sessionMessages, $this->messages);
    }

    /**
     * Getter for the session container
     *
     * This function initialises the session container on demand
     *
     * @return SessionContainer
     */
    public function getSessionContainer()
    {
        if (!$this->sessionContainer) {
            $this->sessionContainer = new SessionContainer('zeal_messages');
        }

        return $this->sessionContainer;
    }

    /**
     * Adds a message
     *
     * @param  string $type
     * @param  string $message
     * @return Messages
     */
    protected function addMessage($type, $message)
    {
        if (!isset($this->messages[$type])) {
            $this->messages[$type] = array();
        }

        $this->messages[$type][] = $message;
    }

    /**
     * Adds an info message
     *
     * @param  string $message
     * @return Messages
     */
    public function info($message)
    {
        return $this->addMessage('info', $message);
    }

    /**
     * Adds an error message
     *
     * @param  string $message
     * @return Messages
     */
    public function error($message)
    {
        return $this->addMessage('error', $message);
    }

    /**
     * Adds a success message
     *
     * @param  string $message
     * @return Messages
     */
    public function success($message)
    {
        return $this->addMessage('success', $message);
    }

    /**
     * Adds a flash message (stored in the session container)
     *
     * @param string $type
     * @param string $message
     */
    protected function addFlashMessage($type, $message)
    {
        if (!is_scalar($type) || strpos($type, ' ') !== false) {
            throw new \Exception('Invalid flash message type supplied');
        }

        $container = $this->getSessionContainer();

        if (!$this->flashMessageAdded) {
            $container->setExpirationHops(1, null);
            $this->flashMessageAdded = true;
        }

        if (!isset($container->messages)) {
            $container->messages = array();
        }

        if (!isset($container->messages[$type])) {
            $container->messages[$type] = array();
        }

        $container->messages[$type][] = $message;

        return $this;
    }

    /**
     * Add a flash information message
     *
     * @param  string $message
     * @return Messages
     */
    public function flashInfo($message)
    {
        return $this->addFlashMessage('info', $message);

    }

    /**
     * Add a flash error message
     *
     * @param  string $message
     * @return Messages
     */
    public function flashError($message)
    {
        return $this->addFlashMessage('error', $message);
    }

    /**
     * Add a flash success message
     *
     * @param  string $message
     * @return Messages
     */
    public function flashSuccess($message)
    {
        return $this->addFlashMessage('success', $message);
    }
}

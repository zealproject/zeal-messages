<?php

namespace ZealMessages\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZealMessages\Controller\Plugin\Messages as MessagesPlugin;

class Messages extends AbstractHelper
{
    protected $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function __invoke()
    {
        if (count($this->messages) == 0) {
            return '';
        }

        $html = '';
        foreach ($this->messages as $key => $messagesArray) {
            $html .= '<ul class="'.$key.'"><li>'.implode('</li><li>', $messagesArray).'</li></ul>';
        }

        return '<div id="messages">'.$html.'</div>';
    }
}

<?php

namespace ZealMessages\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ZealMessages\Controller\Plugin\Messages as MessagesPlugin;

class Messages extends AbstractHelper
{
    public function __invoke()
    {
        $messages = MessagesPlugin::getMessages();

        if (count($messages) == 0) {
            return '';
        }

        $html = '';
        foreach ($messages as $key => $messagesArray) {
            $html .= '<ul class="'.$key.'"><li>'.implode('</li><li>', $messagesArray).'</li></ul>';
        }

        return '<div id="messages">'.$html.'</div>';
    }
}

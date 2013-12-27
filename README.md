Zeal Messages
=============

This module provides an easy way of displaying messages to the user. It is designed as an alternative to ZF's flash messenger, and in additional to the flash messenger's functionality, includes the ability to set different types of message (e.g. 'info' messages, 'error' messages), and functionality to show messages to the user immediately (rather than on the next request as the flash messenger does).

## Installation

The best way to install the module is with Composer (http://getcomposer.org). Add this to your `composer.json`:

    "require": {
        "zealproject/zeal-messages": "dev-master"
    }

then run `composer install` to install.

You'll also need to edit your `application.config.php` to add `ZealMessages` to your module array.

## Usage

To add messages, from a controller action, to show a message to the user immediately:

```php
$this->messages()->info('Your message here');
```

or an error message:

```php
$this->messages()->error('Your error message here');
```

'success' messages are also supported.

To add flash messages (which are added to the session and shown to the user on the subsequent request), usage is:

```php
$this->messages()->flashInfo('Your message here');
```

or:

```php
$this->messages()->flashError('Your error message here');
```

and so on.

So a controller action that processes form data might look like:

```php
public function editAction()
{
    [load data and setup $form]

    if ($this->getRequest()->isPost()) {
        $form->setData($this->getRequest()->getPost());
        if ($form->isValid()) {
            $data = $form->getData();

            if ([code to save $data]) {
                $this->messages()->flashInfo('Your details were successfully saved');
                $this->redirect()->toRoute([some route]);
            } else {
                $this->messages()->error('An error occurred saving your details');
            }
        }
    }

    return new ViewModel(array(
        'form' => $form
    ));
}
```

### Rendering messages

The module includes a view helper for rendering messages. You would typically add this your layout, above the view content:

```php
<?=$this->messages()?>
```

It will only output HTML if there are some messages to display.

The messages are output in an unordered list (one list per type) within a div with the id `messages` for easy CSS styling. Each list has the message type as the class name, for example:

    <div id="messages">
        <ul class="info">
            <li>Your details were successfully saved</li>
        </ul>
    </div>



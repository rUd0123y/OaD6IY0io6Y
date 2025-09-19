<?php
// 代码生成时间: 2025-09-19 08:41:00
// notification_system.php
// 使用Symfony框架实现的消息通知系统

require_once 'vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

// 定义事件名称
class NotificationEvents {
    const MESSAGE_SENT = 'notification.message_sent';
}

// 消息类
class Message {
    protected $content;

    public function __construct($content) {
        $this->content = $content;
    }

    public function getContent() {
        return $this->content;
    }
}

// 消息发送者接口
interface MessageSenderInterface {
    public function send(Message $message);
}

// 邮件消息发送者
class EmailMessageSender implements MessageSenderInterface {
    public function send(Message $message) {
        // 邮件发送逻辑
        echo "Sending email with content: " . $message->getContent() . "\
";
    }
}

// SMS消息发送者
class SmsMessageSender implements MessageSenderInterface {
    public function send(Message $message) {
        // SMS发送逻辑
        echo "Sending SMS with content: " . $message->getContent() . "\
";
    }
}

// 事件监听器
class NotificationListener implements EventSubscriberInterface {
    private $messageSender;

    public function __construct(MessageSenderInterface $messageSender) {
        $this->messageSender = $messageSender;
    }

    public static function getSubscribedEvents() {
        return [
            NotificationEvents::MESSAGE_SENT => 'onMessageSent',
        ];
    }

    public function onMessageSent(Message $message) {
        try {
            $this->messageSender->send($message);
        } catch (Exception $e) {
            // 错误处理
            echo "Error sending message: " . $e->getMessage() . "\
";
        }
    }
}

// 事件分发器
$dispatcher = new EventDispatcher();

// 依赖注入容器
$container = new ContainerBuilder();

// 注册邮件发送者服务
$container->register('email_sender', EmailMessageSender::class);

// 注册SMS发送者服务
$container->register('sms_sender', SmsMessageSender::class);

// 注册事件监听器服务，并注入消息发送者
$container->register('notification_listener', NotificationListener::class)
    ->addArgument(new Reference('email_sender')); // 可以根据需要注入不同的发送者

// 从容器中获取事件监听器
$listener = $container->get('notification_listener');

// 将事件监听器添加到事件分发器
$dispatcher->addSubscriber($listener);

// 触发消息发送事件
$message = new Message("Hello, this is a test message!");
$dispatcher->dispatch(NotificationEvents::MESSAGE_SENT, new \Symfony\Component\EventDispatcher\GenericEvent($message));

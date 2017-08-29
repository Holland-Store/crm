<?php
/**
 * Created by PhpStorm.
 * User: Rus
 * Date: 28.08.2017
 * Time: 16:38
 */

namespace console\models;


use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;
use yii\helpers\Html;

class SocketServer implements WampServerInterface
{
    protected $subscribedTopic = [];

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $subject = $topic->getId();
        if (!array_key_exists($subject, $this->subscribedTopic)){
            $this->subscribedTopic[$subject] = $topic;
        }
    }

    public function onPushEventData($event)
    {
        $eventData = json_decode($event, true);
        if (!array_key_exists($eventData['subscribeKey'], $this->subscribedTopic)){
            return;
        }

        $topic = $this->subscribedTopic[$eventData['subscribeKey']];

        if ($topic instanceof Topic) {
            foreach ($eventData as $eventField => &$fieldValue)
                $fieldValue = Html::encode($fieldValue);

            $topic->broadcast($eventData);
        } else {
            return;
        }
    }

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        $conn->close();
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {

    }

    public function onOpen(ConnectionInterface $conn)
    {

    }

    public function onClose(ConnectionInterface $conn)
    {

    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {

    }
}
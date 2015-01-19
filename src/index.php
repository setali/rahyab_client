<?php
namespace Opilo\RahyabClient;
require __DIR__ . '/../vendor/autoload.php';
include 'ClientManager.php';




$cl = new ClientManager('soap', 'username', 'password');

var_dump($cl->getConnector()->sendSms('50001********', ['9*********','9*********'], 'Test Message', false));
var_dump($cl->getConnector()->getCredit());
var_dump($cl->getConnector()->getMessages(0));
var_dump($cl->getConnector()->getMessagesStatus(['1','2']));
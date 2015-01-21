<?php
namespace Opilo\RahyabClient;
require __DIR__ . '/../vendor/autoload.php';
include 'ClientManager.php';




$cl = new ClientManager('soap', 'username', 'password');

var_dump($cl->getConnector()->sendSms('50001', ['9350000000','9300000000'], 'Lorem ipsum dolor sit amet, consectetuer', false));
var_dump($cl->getConnector()->getCredit());
var_dump($cl->getConnector()->getMessages(0));
var_dump($cl->getConnector()->getMessagesStatus(['1948512018','1948512019']));
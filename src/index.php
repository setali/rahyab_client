<?php
namespace Opilo\RahyabClient;
require __DIR__ . '/../vendor/autoload.php';

include 'ClientManager.php';




        $cl = new \Opilo\RahyabClient\ClientManager('soap', 'azarbad', 'az@rBad');


        var_dump($cl->getConnector()->sendSms('5000125685745', ['09358512864','09308328488'], 'Test Message', false));
        var_dump($cl->getConnector()->getCredit());
        var_dump($cl->getConnector()->getMessages(0));
        var_dump($cl->getConnector()->getMessagesStatus(['1','2']));
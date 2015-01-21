<?php

use Opilo\RahyabClient\Exceptions\RahyabSoapException;
use Opilo\RahyabClient\Connectors\SoapConnector;

require __DIR__ . '/../vendor/autoload.php';

class TestBase extends PhpUnit_framework_TestCase {

    /**
     * @var SoapConnector
     */
    private $soapConnector;

    /**
     * @var \SoapClient
     */
    private $soapClient;


    /**
     *  Create Mock SoapClient
     *  Create SoapConnector
     * @return void
     */
    public function setUp()
    {
        $this->soapClient = Mockery::mock('SoapClient');
        $this->soapConnector = new SoapConnector('123', '234', $this->soapClient);
    }

    public function testGetCredit()
    {
        $this->soapClient->shouldReceive('doGetInfo')->once()->with(
            [
                'uUsername' => '123',
                'uPassword' => '234'
            ]

        )->andReturn((object)['doGetInfoResult'=>'Qnty;1;']);
        $result = $this->soapConnector->getCredit();
        $this->assertEquals(1, $result);
    }

    public function testSendSms()
    {
        $parameters['uUsername'] = '123';
        $parameters['uPassword'] = '234';
        $parameters['uNumber'] = '50000';
        $parameters['uCellphones'] = '9300000000;9100000000';
        $parameters['uMessage'] = 'TEST MESSAGE';
        $parameters['uFarsi'] = false;
        $parameters['uTopic'] =  false;
        $parameters['uFlash'] = false;
        $this->soapClient->shouldReceive('doSendSMS')->once()->with($parameters)->andReturn((object)['doSendSMSResult'=>'Send Ok']);
        $result = $this->soapConnector->sendSms('50000', ['9300000000','9100000000'], 'TEST MESSAGE', false);
        $this->assertEquals('Send Ok', $result);
    }

    public function testGetMessagesStatus()
    {
        $this->soapClient->shouldReceive('doGetDelivery')->once()->with(
            [
                'uUsername' => '123',
                'uReturnIDs'=> '12346789;2;8;96354;789635'
            ]

        )->andReturn((object)['doGetDeliveryResult'=>'0;2;-1;9;5']);
        $result = $this->soapConnector->getMessagesStatus(['12346789','2','8','96354','789635']);
        $this->assertEquals('0;2;-1;9;5', $result);
    }

    public function testGetMessages()
    {
        $this->soapClient->shouldReceive('doReceiveSMSArray')->once()->with(
            [
                'uUsername' => '123',
                'uPassword' => '234',
                'uLastRowID' => 0,
            ]

        )->andReturn((object)['doReceiveSMSArrayResult'=>
                                ["MessageReceive"=>
                                    [   "RowID"=> 38262314,
                                        "DateTime"=>"2015/01/21 12:02:19",
                                        "Sender" => "9300000000",
                                        "Receiver"=>"50001",
                                        "Message"=>"Hi"
                                    ]
                                ]
                            ]);
        $result = $this->soapConnector->getMessages('0');
        $t = ["MessageReceive"=>
                    [   "RowID"=> 38262314,
                        "DateTime"=>"2015/01/21 12:02:19",
                        "Sender" => "9300000000",
                        "Receiver"=>"50001",
                        "Message"=>"Hi"
                    ]
            ];
        $this->assertEquals($t, $result);
    }

}
<?php

namespace Opilo\RahyabClient\Connectors;


use Opilo\RahyabClient\Exceptions\RahyabSoapException;

class SoapConnector implements  ConnectorInterface {

    const WSDL = 'http://79.175.169.230:8020/WebService/sms.asmx?WSDL';

    const TIME_OUT = 120;

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;

    /**
     * @var \SoapClient
     */
    private $soapClient;


    /**
     * @param $wsdl
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;

        $this->password = $password;
    }


    /**
     * Create a new Soap instance
     *
     * @throws RahyabSoapException
     * @return object
     */
    public function connect()
    {
        if (!isset($this->soapClient)) {

            try
            {
                $params = array(
                    'trace' => true,
                    'exceptions' => true,
                    'compression' => SOAP_COMPRESSION_ACCEPT,
                    'connection_timeout' => self::TIME_OUT,
                    'cache_wsdl' => WSDL_CACHE_BOTH,
                );
                $this->soapClient = new \SoapClient(self::WSDL, $params);


            } catch (\SoapFault $e)
            {
                throw new SoapConnectionException('Invalid or unknown status');
            }
        }

        return $this->soapClient;
    }



    /**
     * Send SMS from given sources to destinations
     *
     * @param string|array $sources
     * @param string|array $destinations
     * @param string|array $message
     * @param int|array    $encoding
     * @return array
     */
    public function sendSms($sources, $destinations, $message, $encoding)
    {
        try
        {
                $parameters['uUsername'] = $this->username;
                $parameters['uPassword'] = $this->password;
                $parameters['uNumber'] = $sources;
                $parameters['uCellphones'] = implode(';', $destinations);
                $parameters['uMessage'] = $message;
                $parameters['uFarsi'] = $encoding;
                $parameters['uTopic'] = "false";
                $parameters['uFlash'] = "false";

                $response=$this->connect()->doSendSMS($parameters);
                return $response->doSendSMSResult;

        } catch (\SoapFault $e)
        {
//            var_dump('error');
            throw new SoapConnectionException('Invalid or unknown status');
        }
    }


    /**
     *
     * @return int
     */
    public function getCredit()
    {
        $response = $this->connect()->doGetInfo(
            [
                'uUsername' => $this->username,
                'uPassword' => $this->password
            ]
        );
        $result = explode(';',$response->doGetInfoResult);
        return $result[1];
    }


    /**
     * Get status of sent messages
     *
     * @param int|array $messageIds
     * @return array
     */
    public function getMessagesStatus($messageIds)
    {
        $response = $this->connect()->doGetDelivery(
            [
                'uUsername' => $this->username,
                'uReturnIDs'=> implode(';', $messageIds)
            ]
        );


        return $response->doGetDeliveryResult;
    }


    /**
     * @return array
     * @throws SoapConnectionException
     */
    public function getMessages($lastRowId)
    {
        $response = $this->connect()->doReceiveSMS(
            [
                'uUsername' => $this->username,
                'uPassword' => $this->password,
                'uLastRowID' => $lastRowId,
            ]
        );

        return $response->doReceiveSMSResult;
    }


}
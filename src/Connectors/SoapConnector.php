<?php

namespace Opilo\RahyabClient\Connectors;


use Opilo\RahyabClient\Exceptions\RahyabSoapException;

class SoapConnector implements  ConnectorInterface {



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
     * @param $username
     * @param $password
     * @param \SoapClient $soapClient
     */
    public function __construct($username, $password, $soapClient)
    {
        $this->username = $username;

        $this->password = $password;

        $this->soapClient = $soapClient;
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
                $parameters['uTopic'] = false;
                $parameters['uFlash'] = false;

                $response=$this->soapClient->doSendSMS($parameters);
                return $response->doSendSMSResult;

        } catch (\SoapFault $e)
        {
            throw new SoapConnectionException('Invalid or unknown status');
        }
    }


    /**
     *
     * @return int
     */
    public function getCredit()
    {
        $response = $this->soapClient->doGetInfo(
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
        $response = $this->soapClient->doGetDelivery(
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
        $response = $this->soapClient->doReceiveSMSArray(
            [
                'uUsername' => $this->username,
                'uPassword' => $this->password,
                'uLastRowID' => $lastRowId,
            ]
        );

        return $response->doReceiveSMSArrayResult;
    }


}
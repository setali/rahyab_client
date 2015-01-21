<?php
/**
 * Created by PhpStorm.
 * User: kasper
 * Date: 1/20/15
 * Time: 5:10 PM
 */

namespace Opilo\RahyabClient;


class ClientFactory{

    const WSDL = 'http://79.175.169.230:8020/WebService/sms.asmx?WSDL';

    const TIME_OUT = 120;

    /**
     * @return \SoapClient
     * @throws SoapConnectionException
     */
    public static function getRahyabSoapClient()
    {
        try
        {
            $params = array(
                'trace' => true,
                'exceptions' => true,
                'compression' => SOAP_COMPRESSION_ACCEPT,
                'connection_timeout' => self::TIME_OUT,
                'cache_wsdl' => WSDL_CACHE_BOTH,
            );
            return new \SoapClient(self::WSDL, $params);

        } catch (\SoapFault $e)
        {
            throw new SoapConnectionException('Invalid or unknown status');
        }

    }

}
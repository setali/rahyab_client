<?php namespace Opilo\RahyabClient\Connectors;

interface ConnectorInterface {

    /**
     * Send SMS from given sources to destinations
     *
     * @param string|array $sources
     * @param string|array $destinations
     * @param string|array $message
     * @param int|array    $encoding
     * @throws SoapConnectionException
     * @return int|array
     */
    public function sendSms($sources, $destinations, $message, $encoding);

    /**
     * Get status of sent messages
     *
     * @param int|array $messageIds
     * @throws SoapConnectionException
     * @return array
     */
    public function getMessagesStatus($messageIds);

    /**
     *
     * @return array
     * @throws SoapConnectionException
     */
    public function getMessages($lastRowId);



    /**
     *
     * @return int
     * @throws SoapConnectionException
     */
    public function getCredit();
}

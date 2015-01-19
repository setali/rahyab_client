<?php
/**
 * Created by PhpStorm.
 * User: kasper
 * Date: 1/18/15
 * Time: 9:54 AM
 */

namespace Opilo\RahyabClient;


class ClientManager {

    const REST = 'rest';

    const SOAP = 'soap';

    /**
     * @var string
     */
    protected $connection_type;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @param string $connectionType
     */
    public function __construct($connection_type,$username, $password)
    {
        $this->connectionType = $connection_type;
        $this->username       = $username;
        $this->password       = $password;
    }


    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method,$parameters)
    {
        $callable = [$this->getConnector($this->username, $this->password), $method];
        return call_user_func_array($callable, $parameters);
    }

    /**
     * Create a connector
     *
     * @return \Opilo\RahyabClient\Connectors\ConnectorInterface
     */
    public  function getConnector()
    {
        if (empty($this->connector)) {

            $connectorClass = __NAMESPACE__ . '\\Connectors\\' . ucfirst($this->connectionType) . 'Connector';

            $this->connector = new $connectorClass($this->username, $this->password);
        }

        return $this->connector;
    }

}
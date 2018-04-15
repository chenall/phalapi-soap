<?php
namespace PhalApi\SOAP;
/**
 * SOAP服务
 * @author chenall 20180415
 */

class Lite {

    public function __construct($response = null) {
        $this->di = \PhalApi\DI();
        if (empty($response)) $response = __NAMESPACE__.'\Response';
        $this->di->response = new $response();
    }

    public function response() {
        if (isset($_GET['wsdl'])){
            $disc = new SoapDiscovery(__NAMESPACE__.'\PhalApi', 'soap');
            header("Content-type: text/xml; charset=utf-8");
            $xml = $disc->getWSDL();
            echo trim($xml);
            exit;
        }
        try {
            $config = $this->di->config->get('SOAP');

            $server = new \SOAPServer(
                $config['wsdl'],
                $config['options']
            );

            $server->setClass(__NAMESPACE__.'\PhalApi');
            return $server->handle();
        } catch (SOAPFault $f) {
            $this->di->logger->error('SAOPFault', $f->faultstring);
            return FALSE;
        }
    }
}

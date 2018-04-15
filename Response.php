<?php
namespace PhalApi\SOAP;

class Response extends \PhalApi\Response {
    public function __construct($options = 0) {
        $this->addHeaders('Content-Type', 'text/xml;charset=utf-8');
    }

    protected function formatResult($result) {
        return $result;
    }
}
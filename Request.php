<?php
namespace PhalApi\SOAP;

class Request extends \PhalApi\Request{
    public function __construct($data = NULL) {
        //主数据和POST数据都来源于SOAPClient调用参数
        parent::__construct($data);
        $this->post     = $data;
    }
}
<?php
namespace PhalApi\SOAP;

class PhalApi {

    protected $phalapi;

    public function __construct($phalapi = NULL) {

        if ($phalapi === NULL) {
            $phalapi = new \PhalApi\PhalApi();
        }

        $this->phalapi = $phalapi;
    }

    public function api($s=null,$data = []) {
        if (!is_array($data) && !is_object($data))
        {
            $data = json_decode($data, TRUE);
        }

        if (empty($s)){
            $data['s'] = "App.Site.Index";
        } else {
            $data['s'] = $s;
        }
        //修改默认request服务（主要用于设置请求数据）
        \PhalApi\DI()->request = new Request($data);

        $rs = $this->phalapi->response();
        return $rs->getResult();
    }
}

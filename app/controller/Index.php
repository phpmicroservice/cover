<?php

namespace app\controller;

/**
 * 测试
 * Class Demo
 * @package app\controller
 */
class Index extends \app\Controller
{

    /**
     * 获取封面信息
     *
     */
    public function info4id()
    {
        $ob_id = $this->getData('id');
        $server = new \app\logic\Cover();
        $re = $server->info4id($ob_id);
        $this->send($re);
    }

}
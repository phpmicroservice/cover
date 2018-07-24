<?php

namespace app\controller;

use app\Controller;

/**
 * 封面相关 和 主图
 * Class Cover
 * @package app\controller
 */
class Cover extends Controller
{

    /**
     * 设置封面
     */
    public function setcover()
    {
        $file_id = $this->getData('file_id');
        $article_id = $this->getData('ob_id');
        $type = $this->getData('type');
        $server_name = $this->getData('server_name');
        $server = new \app\logic\Cover();
        $re = $server->setcover($article_id, $type, $server_name, $file_id);
        $this->send($re);
    }

    /**
     * 设置封面
     */
    public function setcover4id()
    {
        $file_id = $this->getData('file_id');
        $id = $this->getData('id');
        $server = new \app\logic\Cover();
        $re = $server->setcover4id($id, $file_id);
        $this->send($re);
    }


    /**
     * 获取封面信息
     */
    public function info()
    {
        $ob_id = $this->getData('ob_id');
        $type = $this->getData('type');
        $server_name = $this->getData('server_name');
        $server = new \app\logic\Cover();
        $re = $server->info($ob_id, $type, $server_name);
        $this->send($re);
    }


    public function newinfo()
    {

        $type = $this->getData('type');
        $server_name = $this->getData('server_name');
        $server = new \app\logic\Cover();
        $re = $server->newinfo( $type, $server_name);
        $this->send($re);
    }
}
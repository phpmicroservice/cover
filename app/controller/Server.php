<?php

namespace app\controller;

use app\Controller;

/**
 * 服务间的使用
 * Class Service
 * @package app\controller
 */
class Server extends Controller
{

    /**
     * 封面列表
     */
    public function cover_list()
    {
        $article_id_list = $this->getData('ob_id_list');
        $type = $this->getData('type');
        $server = new \app\logic\Cover();
        $re = $server->cover_list4id($article_id_list, $type);
        $this->send($re);
    }

    /**
     * 封面集合信息
     */
    public function cover_info()
    {
        $id = $this->getData('id');
        $server = new \app\logic\Cover();
        $re = $server->info4id($id);
        $this->send($re);
    }

    /**
     * 封面集合信息
     */
    public function cover_info2()
    {
        $ob_id = $this->getData('ob_id');
        $type = $this->getData('type');
        $server_name = $this->connect->f;
        $server = new \app\logic\Cover();
        $re = $server->info2($ob_id, $type, $server_name);
        $this->send($re);
    }




}
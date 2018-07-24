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
     * 验证是否存在
     */
    public function va_ex()
    {
        $id = $this->getData('id');
        $server = new \app\logic\Article();
        $re = $server->va_ex($id);
        $this->send($re);
    }

    /**
     *
     * 获取分类列表
     */
    public function cate_list()
    {
        $where = $this->getData();
        $server = new \app\logic\Cate();
        $re = $server->lists($where);
        $this->send($re);
    }


    public function cover_list()
    {
        $article_id_list = $this->getData('ob_id_list');
        $type = $this->getData('type');
        $server = new \app\logic\Cover();
        $re = $server->cover_list4id($article_id_list,$type);
        $this->send($re);
    }



}
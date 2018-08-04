<?php

namespace app\controller;

use app\logic\Articleedit;
use app\model\product;

/**
 * 回调核实控制器
 * Class Verify
 * @package app\controller
 */
class Verify extends \app\Controller
{
    /**
     * 产品的核实
     */
    public function cover()
    {
        $ob_id = $this->getData('ob_id');
        $id = $this->getData('id');
        $type = $this->getData('type');
        $server_name = $this->connect->f;
        $info = \app\model\cover::findFirst([
            'ob_id =:ob_id: and id=:id: and type = :type: and sn = :server_name:',
            'bind' => [
                'ob_id' => $ob_id,
                'type' => $type,
                'server_name' => $server_name,
                'id'=>$id
            ]
        ]);
        $this->send($info instanceof \app\model\cover) ;
    }

}
<?php

namespace app\logic;

use app\Base;
use pms\Validation;

/**
 * 封面
 * Class Cover
 * @package app\logic
 */
class Cover extends Base
{

    /**
     *
     * @param array $article_id_list
     */
    public function cover_list4id(array $article_id_list, string $type)
    {
        if(empty($article_id_list)){
            return [];
        }
        $article_list = \app\model\cover::find([
            'ob_id IN ({ob_id_list:array}) and type = :type:',
            'bind' => [
                'ob_id_list' => $article_id_list,
                'type' => $type
            ]
        ]);
        if (empty($article_list)) {
            return [];
        }
        $list = $article_list->toArray();
        output([$article_id_list, $list]);
        return array_column($list, null, 'ob_id');

    }

    /**
     * 设置封面
     * @param $article_id
     * @param $file_id
     */
    public function setcover($article_id, $type, $server_name, $file_id)
    {
        # 读取数据
        $info = $this->info($article_id, $type, $server_name);
        if (!($info instanceof \app\model\cover)) {
            return false;
        }

        # 验证完成
        if (!($info instanceof \app\model\cover)) {
            return false;
        }
        $info->cover_file_id = $file_id;
        if (!$info->save()) {
            return $info->getMessages();
        }
        return true;
    }


    /**
     * 设置封面
     * @param $article_id
     * @param $file_id
     */
    public function setcover4id($id, $file_id)
    {
        # 读取数据
        $info = \app\model\cover::findFirst($id);
        if (!($info instanceof \app\model\cover)) {
            return false;
        }

        # 验证完成
        if (!($info instanceof \app\model\cover)) {
            return false;
        }
        $info->cover_file_id = $file_id;
        if (!$info->save()) {
            return $info->getMessages();
        }
        return true;
    }

    /**
     * 获取一个与之新封面信息
     * @param $type
     * @param $server_name
     * @return \app\model\cover|bool
     */
    public function newinfo($type, $server_name)
    {
        $data = [
            'user_id' => 0,
            'remark' => 'cover_cover',
            'only' => 0
        ];

        $re = $this->proxyCS->request_return('file', '/server/create_array', $data);
        if (is_array($re) && !$re['e'] && is_int($re['d'])) {
            # 成功创建
            $data = [
                'ob_id' => 0,
                'type' => $type,
                'server_name' => $server_name,
                'file_array_id' => $re['d'],
                'cover_file_id' => 0
            ];
            $model = new \app\model\cover();
            if (!$model->save($data)) {
                return false;
            }
            return $model;
        }
    }

    public function info4id($id)
    {
        # 读取已存在的封面
        $info = \app\model\cover::findFirst($id);
        if($info instanceof \app\model\cover){
            return $this->file_list($info->toArray());
        }
        return $info;
    }

    /**
     * 获取封面你的信息
     * @param $article_id
     */
    public function info($article_id, $type, $server_name)
    {
        # 读取已存在的封面
        $info = \app\model\cover::findFirst([
            'ob_id =:ob_id: and type = :type: and sn = :server_name:',
            'bind' => [
                'ob_id' => $article_id,
                'type' => $type,
                'server_name' => $server_name
            ]
        ]);

        if (empty($info)) {
            # 不存在,初始化
            # 创建一个集合
            $data = [
                'user_id' => 0,
                'remark' => 'cover',
                'only' => 0
            ];
            $re = $this->proxyCS->request_return('file', '/server/create_array', $data);
            if (is_array($re) && !$re['e'] && is_int($re['d'])) {
                # 成功创建
                $data147 = [
                    'ob_id' => $article_id,
                    'type' => $type,
                    'sn' => $server_name,
                    'file_array_id' => $re['d'],
                    'cover_file_id' => 0
                ];
                var_dump($data147);
                $model = new \app\model\cover();
                if (!$model->save($data147)) {
                    return $model->getMessage();
                }
                return $model;
            } else {
                return false;
            }
        }
        return $info;
    }

    /**
     * 获取封面你的信息,不自动创建
     * @param $article_id
     */
    public function info2($article_id, $type, $server_name, $file_list = true)
    {
        # 读取已存在的封面
        $info = \app\model\cover::findFirst([
            'ob_id =:ob_id: and type = :type: and sn = :server_name:',
            'bind' => [
                'ob_id' => $article_id,
                'type' => $type,
                'server_name' => $server_name
            ]
        ]);
        if ($info instanceof \app\model\cover) {
            $arr = $info->toArray();
            if ($file_list) {
                return $this->file_list($arr);
            }
            return $arr;
        } else {
            return false;
        }
    }

    private function file_list($arr)
    {
        $info = $this->proxyCS->request_return('file', '/server/arrayfilelist', ['array_id' => $arr['file_array_id']]);
        var_dump($info);
        if (!is_array($info) || $info['e']) {
            $arr['filelist'] = [];
        } else {
            $arr['filelist'] = $info['d'];
        }
        return $arr;
    }

}
<?php

namespace app\task;

use app\filterTool\Regs;
use app\logic\Reg;
use pms\Task\TaskInterface;

/**
 * SetObTx 设置对象id ,仅限 预定义的封面对新
 * Class SetObTx
 * @package app\task
 */
class SetObTx extends \pms\Task\TxTask implements TaskInterface
{
    public function end()
    {

    }

    /**
     * 在依赖处理之前执行,没有返回值
     */
    protected function b_dependenc()
    {
        $data = $this->getData();

    }

    /**
     * 事务逻辑内容,返回逻辑执行结果,
     * @return bool false失败,将不会再继续进行;true成功,事务继续进行
     */
    protected function logic()
    {
        return false;
    }
}
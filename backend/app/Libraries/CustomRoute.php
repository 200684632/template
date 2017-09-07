<?php
/**
 * User: liwd0203@gmail.com
 * Date: 2017/9/7
 * Time: 上午8:36
 */

namespace App\Libraries;


use Illuminate\Routing\Route;

class CustomRoute extends Route
{
    /**
     * 路由添加备注，知道是干什么的
     *
     * @param string $remarks
     * @return $this
     */
    public function remark($remarks = '')
    {
        $this->action['remark'] = $remarks;

        return $this;
    }

    public function getRemark()
    {
        return $this->action['remark'] ?? null;
    }
}

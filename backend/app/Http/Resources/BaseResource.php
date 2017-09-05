<?php
/**
 * User: liwd0203@gmail.com
 * Date: 2017/9/4
 * Time: 下午5:00
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\Resource;

class BaseResource extends Resource
{
    protected $includes = [];

    public function getIncludes()
    {
        $includes = [];

        foreach ($this->includes as $value) {
            $key = str_replace('include', '', $value);

            $key[0] = strtolower($key[0]);

            $includes[$key] = $this->{$value}();
        }

        return $includes;
    }
}
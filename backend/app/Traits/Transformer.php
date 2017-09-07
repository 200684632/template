<?php

namespace App\Traits;

use App\Libraries\CustomPagination;
use App\Libraries\DataArraySerializer;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

trait Transformer
{
    /**
     * 序列化转换单个Object
     */
    protected function fractalItem($item, $transformer)
    {
        if (class_exists($transformer)) {
            $result = new $transformer($item);

            return $result->toArray();
        }

        return [];
    }

    /**
     * 序列化转换Object数组
     */
    protected function fractalItems($items, $transformer)
    {
        if (class_exists($transformer)) {
            $result = $transformer::collection($items);

            return $result->toArray();
        }

        return [];
    }

    /**
     * 序列化转换Object数组并添加分页信息
     */
    protected function factalPaginator($items, $transformer)
    {
        if (class_exists($transformer)) {
            $class = $transformer::collection($items);

            $result = new CustomPagination($class);

            return $result->toResponse($result);
        }
    }

}

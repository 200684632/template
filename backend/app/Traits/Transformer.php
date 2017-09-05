<?php

namespace App\Traits;

use App\Libraries\DataArraySerializer;
use Spatie\Fractalistic\Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

trait Transformer
{
    /**
     * Fractal 序列化转换单个Object
     */
    protected function fractalItem($item, $transformer, $includes=[])
    {
        $data = Fractal::create($item, $transformer)
                ->parseIncludes($includes)
                ->serializeWith(new DataArraySerializer())
                ->toArray();

        return $data['data'];
    }

    /**
     * Fractal 序列化转换Object数组
     */
    protected function fractalItems($items, $transformer, $includes=[])
    {
        $data = Fractal::create($items, $transformer)
                ->serializeWith(new DataArraySerializer())
                ->parseIncludes($includes)
                ->toArray();

        return $data['data'];
    }

    /**
     * Fractal 序列化转换Object数组并添加分页信息
     */
    protected function factalPaginator($paginator, $transformer, $includes=[])
    {
        $data = Fractal::create()
                ->serializeWith(new DataArraySerializer())
                ->collection($paginator->getCollection())
                ->transformWith($transformer)
                ->parseIncludes($includes)
                ->paginateWith(new IlluminatePaginatorAdapter($paginator))
                ->toArray();

        return $data;
    }

}
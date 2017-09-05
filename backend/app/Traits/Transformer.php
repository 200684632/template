<?php
/**
 * Created by IntelliJ IDEA.
 * User: liwd
 * Date: 2017/9/4
 * Time: 上午8:52
 */

namespace App\Traits;

use App\Libraries\CustomPagination;

trait Transformer
{
    public function fractalItem($item, $transformer)
    {
        if (class_exists($transformer)) {
            $result = new $transformer($item);

            return $result->toArray($result);
        }

        return [];
    }

    public function fractalItems($items, $transformer)
    {
        if (class_exists($transformer)) {
            $result = $transformer::collection($items);

            return $result->toArray($result);
        }

        return [];
    }

    public function fractalPaginator($items, $transformer)
    {
        if (class_exists($transformer)) {
            $collectionClass = $transformer::collection($items);

            $result = new CustomPagination($collectionClass);

            return $result->toResponse($result->resource);
        }

        return [];
    }
}
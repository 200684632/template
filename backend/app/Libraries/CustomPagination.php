<?php

/**
 * 用于在transformer的时候直接返回符合格式的数组
 */

namespace App\Libraries;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class CustomPagination extends PaginatedResourceResponse
{
    protected function paginationInformation($request)
    {
        $paginated = $this->resource->resource->toArray();

        return [
            'meta' => [
                'links' => $this->paginationLinks($paginated),
                'pagination' => $this->meta($paginated),
            ]
        ];
    }

    public function toResponse($request)
    {
        $result = $this->wrap(
            $this->resource->resolve($request),
            array_merge_recursive(
                $this->paginationInformation($request),
                $this->resource->with($request),
                $this->resource->additional
            )
        );

        return $result;
    }
}
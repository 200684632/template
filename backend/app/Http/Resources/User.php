<?php

namespace App\Http\Resources;

class User extends BaseResource
{
    protected $includes = ['includeFranchiser'];

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $transform = [
            'id' => $this->id
        ];

        return array_merge($transform, $this->getIncludes());
    }

    public function includeFranchiser()
    {
        if (!$this->franchiser) {
            return null;
        }

        return new Franchiser($this->franchiser);
    }
}

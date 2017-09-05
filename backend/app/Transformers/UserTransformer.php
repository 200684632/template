<?php

namespace App\Transformers;

use App\Http\Resources\Franchiser;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['franchiser'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id
        ];
    }

    public function includeFranchiser(User $user)
    {
        if (! $user->franchiser) {
            return null;
        }

        return $this->item($user->franchiser, new FranchiserTransformer(), false);
    }
}
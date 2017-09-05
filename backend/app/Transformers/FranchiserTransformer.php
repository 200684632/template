<?php
/**
 * User: liwd0203@gmail.com
 * Date: 2017/9/5
 * Time: 下午5:47
 */

namespace App\Transformers;

use App\Franchiser;
use League\Fractal\TransformerAbstract;

class FranchiserTransformer extends TransformerAbstract
{
    public function transform(Franchiser $franchiser)
    {
        return [
            'name' => $franchiser->name
        ];
    }
}
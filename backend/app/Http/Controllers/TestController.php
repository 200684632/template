<?php
/**
 * Created by IntelliJ IDEA.
 * User: liwd
 * Date: 2017/9/1
 * Time: 下午4:10
 */

namespace App\Http\Controllers;

use App\Order;
use App\Traits\Transformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $ret = User::where('id', '>=', 1)->paginate(10);

        $result = [
            'user' => $this->fractalItems($ret, new UserTransformer(), ['franchiser'])
        ];

        return $this->apiSuccess($result);
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: liwd
 * Date: 2017/9/1
 * Time: 下午4:10
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $ret = User::where('id', '>=', 1)->with(['franchiser'])->paginate(10);

        $result = [
            'user' => $this->factalPaginator($ret, \App\Http\Resources\User::class)
        ];

        return $this->apiSuccess($result);
    }
}

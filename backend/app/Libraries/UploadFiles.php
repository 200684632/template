<?php

/**
 * 上传文件类
 */

namespace App\Libraries;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UploadFiles
{
    use ApiResponse;

    private $upyun;

    private $rules = [
        'image' => 'required|max:4000|mimes:jpg,jpeg,gif,png'
    ];

    public function __construct(\Upyun\Upyun $upyun)
    {
        $this->upyun = $upyun;
    }

    /**
     * 正常的上传文件，返回格式符合正常的接口返回格式
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return $this->apiError($validator->errors()->first());
        } else {
            $path = $request->image->store('images' . date('/Y/m/d'), 'public');

            $this->uploadToUpyun($request->image->path(), $path);

            return $this->apiSuccess(['url'=>url(Storage::url($path))]);
        }
    }

    /**
     * 为编辑器编写的上传文件，返回的是文件地址
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function uploadFileForEditor(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return 'error|'.$validator->errors()->first();

        } else {
            $path = $request->image->store('images' . date('/Y/m/d'), 'public');

            $this->uploadToUpyun($request->image->path(), $path);

            return url(Storage::url($path));
        }
    }

    /**
     * 上传文件到又拍云
     *
     * @param $filename
     * @param $path
     */
    private function uploadToUpyun($filename, $path)
    {
        $path = '/storage/' . $path;
        $handle = fopen($filename, 'r');

        $this->upyun->write($path, $handle);
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: liwd
 * Date: 2017/9/7
 * Time: 下午5:02
 */

if (!function_exists('switchDomain')) {
    /**
     * 正则替换域名
     * @param $path
     * @return string
     */
    function switchDomain($path)
    {
        $domain = env('IMAGE_DOMAIN', '');

        if ($domain === '') {
            return $path;
        }

        $pattern = '/^((http:\/\/)|(https:\/\/))([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}/';

        return preg_replace($pattern, $domain, $path);
    }
}

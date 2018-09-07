<?php
/**
 * 公共方法
 * User: lzy <1029460965@qq.com>
 * Date: 2018/8/19
 * Time: 21:35
 */

/**
 * 通用化API接口数据
 * @param int $status 业务状态码
 * @param string $message 信息提示
 * @param array $data 返回数据
 * @param int $httpCode http状态码
 */
function show($status, $message, $data = [], $httpCode = 200){
    $result = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json($result, $httpCode);
};

/**
 * curl
 * @param string $url 请求地址
 * @param int $type 请求类型[0 get | 1 post]
 * @param array $data
 */
function curl($url, $type = 0 , $data = []){
    $ch = curl_init();
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    //只返回结果，不输出内容
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //不输出请求头
    curl_setopt($ch, CURLOPT_HEADER, 0);
    if ($type == 1){
        //post
        curl_setopt($ch, CURLOPT_PORT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //执行并获取内容
    $output = curl_exec($ch);
    //释放
    curl_close($ch);
    return $output;
}

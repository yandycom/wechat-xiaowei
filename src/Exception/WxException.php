<?php
    /**
     * WxException.php
     *
     * Created by PhpStorm.
     * author: liuml  <liumenglei0211@163.com>
     * DateTime: 2018/8/24  16:17
     */

    namespace wei\Exception;
    


    class WxException extends \Exception
    {
        public static $errorMessage = [
            '-1'    => '系统繁忙，请稍后重试',
            '0'     => '操作失败',
            '1'     => '操作成功',
            '10001' => '图片上传失败，请重新上传',
            '10002' => '上传图片格式错误',
            '20000' => '微信响应签名错误',
            '20001' => '请求错误，请稍后重试',
            '20002' => '系统错误，请联系客服人员后重试',    // 加密敏感信息失败
            '20003' => '小微商户开户目前不支持该账号卡片',
            '20004' => '参数错误',
            '20005' => '请勿重复提交申请信息',
            '20006' => '该商户号已经升级过，请直接查询升级状态',
            '30000' => 'xml数据异常！',
            '30001' => '数组数据异常！',
            '30002' => '接口返回数据异常！',
        ];

        public static $defaultMessage = '未知错误';

        public function __construct($code = 0, $message = "")
        {
            if ($message === "") {
                $message            = static::$errorMessage[$code] ?? static::$defaultMessage;
            }
            parent::__construct($message, $code);
        }

        public function getName()
        {
            return 'WxException';
        }

        public function __toString()
        {
            return json_encode($this->getResponse());
        }

        public function getResponse()
        {
            return $this->response;
        }
    }
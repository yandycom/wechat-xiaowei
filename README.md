# wechat-xiaowei
微信小微商户接口 全家桶 PHP SDK
包含了小微商户全部接口（大部分代码来自(WechatXiaowei)https://github.com/liumenglei/WechatXiaowei 感谢前辈）
(微信官方文档)https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=4_1

#### 安装(PHP>=7.0)
> composer require yandy/wechat-xiaowei

#### 使用
    <?php
	use wei/Wechat;
	$config = [
		'appid' => 'wx123456',
        'secret' => '6b9bb37515ebd8f7d08c6329c5f5555',
        'mch_id' => '1245668921',  //商户号
        'serial_no' => '67E04C9243E70B7C38F371E4EB4907F10B171B45',  //商户证书序列号
        'aes_key' => 'abc1abc2abc3abc4abc5abc6abc7abc8',
        'diy_key' => 'abc1abc2abc3abc4abc5abc6abc7abc8',  //自定义key
	];
	$wecaht = new Wechat($config);
    $wechat->downloadCertificates(); //下载证书
    ?>
#### 介绍
陆续更新中...

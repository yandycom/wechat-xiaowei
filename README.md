# wechat-xiaowei
微信小微商户接口 全家桶 PHP SDK
包含了小微商户全部接口（大部分代码来自[WechatXiaowei](https://github.com/liumenglei/WechatXiaowei) 感谢前辈）

[微信官方文档](https://pay.weixin.qq.com/wiki/doc/api/xiaowei.php?chapter=4_1)

#### 安装(PHP>=7.0)
> composer require yandy/wechat-xiaowei

#### 示例
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
	try {
            $res = $wechat->downloadCertificates();   //下载证书
            echo "成功";
        } catch (WxException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    ?>
#### 说明
1.请将证书文件放到Certificate目录下 然后再创建两个空文件 jiemi.json和jiemi.pem 并保证该目录有写入权限

2.下载证书解密返回的密文需要开启libsodium扩展（PHP >= 7.2 安装包自带这个扩展，去php.ini开启一下就行，< 7.2 的需要去安装这个扩展）

3.调用申请入驻等接口里面需要下载证书接口返回的序列号和需要解密后证书 public_key 来加密敏感信息，所以需要先调用下载证书接口


#### 使用
下载证书接口

> $wechat->downloadCertificates();

上传图片接口

> $wechat->uploadImg(); 传入参数media file文件


除了上面两个接口其余接口和参数请参考Wechat.php文件即可



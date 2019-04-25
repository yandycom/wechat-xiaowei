<?php
/**
 * uploadMedia.php
 *
 * Created by PhpStorm.
 * author: yandy  <yandycom@126.com>
 * DateTime: 2019-04-19
 */

namespace wei\Services\Traits;

use wei\Exception\WxException;

trait UploadMedia
{
    protected $media_addr;

    protected $media_hash;

    protected $upload_addr;

    /**
     * uploadImg 图片上传
     * @return array
     * @throws WxException
     */
    public function uploadImg()
    {
        $url = self::WXAPIHOST . 'secapi/mch/uploadmedia';
        // 判断图片地址是否为空，空的话就调用图片上传方法，把图片上传到服务器
        empty($this->media_addr) && $media = $this->saveImg();


        // 判断图片是否存在
        if (!file_exists($this->media_addr))
            throw new WxException(10001);
        $data = [
            'mch_id' => $this->mch_id,
            'media_hash' => $this->hashMedia($this->media_addr),
        ];
        $data['sign_type'] = 'HMAC-SHA256';
        $data['sign'] = $this->makeSign($data, $data['sign_type']);
        // CURLFile 类的解释 http://php.net/manual/zh/class.curlfile.php
        $data['media'] = new \CURLFile($this->media_addr);
        $header = [
            "content-type:multipart/form-data",
        ];
        $res = $this->httpsRequest($url, $data, $header, true);
        var_dump($res); die;

        // 处理返回值
        $rt = $this->disposeReturn($res, ['media_id']);

        return $rt;
    }

    /**
     * saveImg 上传图片到服务器(未做图片上传限制验证)
     * @return string
     * @throws WxException
     */
    public function saveImg()
    {
        $images = $_FILES['media'];


        $this->upload_addr = self::DIR . '/Upload/';

        $info = move_uploaded_file($_FILES["media"]["tmp_name"],
            $this->upload_addr . $_FILES["media"]["name"]);

        if ($info) {
            $this->setMediaAddr($this->upload_addr . $_FILES["media"]["name"]);
            return 1;
        } else {
            throw new WxException($images["error"]);
        }

    }

    /**
     * setMediaAddr 设置图片地址
     * @param $media
     */
    protected function setMediaAddr($media_addr)
    {
        $this->media_addr = $media_addr;
    }

    /**
     * setMediaAddr 设置保存图片地址
     * @param $media
     */
    protected function setSaveAddr($media_addr)
    {
        $this->save_addr = $media_addr;
    }

    /**
     * setMedia 设置历史已上传相同图片的信息
     * @param $media
     */
    protected function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * hashMedia 设置上传图片hash值
     * @param $media_addr
     * @param string $type
     * @return string
     */
    protected function hashMedia($media_addr, $type = 'md5')
    {
        return $this->media_hash ?? hash_file($type, $media_addr);
    }

}
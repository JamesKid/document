#php生成缩略图或者剪切图

/**
     * 取得图像信息
     * @static
     * @access public
     * @param string $image 图像文件名
     * @return mixed
     */
    public function getImageInfo($img) {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }

    /**
     * 生成缩略图
     * @static
     * @access public
     * @param string $image  原图
     * @param string $mode 操作
     * @param string $thumbname 缩略图文件名
     * @param string $maxWidth  宽度
     * @param string $maxHeight  高度
     * @param string $quality 质量
     * @return void
     */
    public function image_resize($image, $width = 200, $height = 200, $mode = 'scale', $thumbname = '', $quality = '100')
    {
        try {
            $imageValue = $this->getImageInfo(Yii::$app->basePath . '/..'.$image);
            $sourceWidth = $imageValue['width']; //原图宽
            $sourceHeight = $imageValue['height']; //原图高
            $thumbWidth = $width; //缩略图宽
            $thumbHeight = $height; //缩略图高
            $_x = 0;
            $_y = 0;
            $w = $sourceWidth;
            $h = $sourceHeight;
            if ($mode == 'scale') {
                if ($sourceWidth <= $thumbWidth && $sourceHeight <= $thumbHeight) {
                    $_x = floor(($thumbWidth - $sourceWidth) / 2);
                    $_y = floor(($thumbHeight - $sourceHeight) / 2);
                    $thumbWidth = $sourceWidth;
                    $thumbHeight = $sourceHeight;
                } else {
                    if ($thumbHeight * $sourceWidth > $thumbWidth * $sourceHeight) {
                        $thumbHeight = floor($sourceHeight * $width / $sourceWidth);
                        $_y = floor(($height - $thumbHeight) / 2);
                    } else {
                        $thumbWidth = floor($sourceWidth * $height / $sourceHeight);
                        $_x = floor(($width - $thumbWidth) / 2);
                    }
                }
            } else if ($mode == 'crop') {
                if ($sourceHeight < $thumbHeight) { //如果原图尺寸小于当前尺寸
                    $thumbWidth = floor($thumbWidth * $sourceHeight / $thumbHeight);
                    $thumbHeight = $sourceHeight;
                }
                if ($sourceWidth < $thumbWidth) {
                    $thumbHeight = floor($thumbHeight * $sourceWidth / $thumbWidth);
                    $thumbWidth = $sourceWidth;
                }

                $s1 = $sourceWidth / $sourceHeight; //原图比例
                $s2 = $width / $height; //新图比例
                if ($s1 == $s2) {

                } else if ($s1 > $s2) { //全高度
                    $y = 0;
                    $ax = floor($sourceWidth * ($thumbHeight / $sourceHeight));
                    $x = ($ax - $thumbWidth) / 2;
                    $w = $thumbWidth / ($thumbHeight / $sourceHeight);

                } else { //全宽度
                    $x = 0;
                    $ay = floor($sourceHeight * ($thumbWidth / $sourceWidth)); //模拟原图比例高度
                    $y = ($ay - $thumbHeight) / 2;
                    $h = $thumbHeight / ($thumbWidth / $sourceWidth);
                }

            }
            $type = strtolower($imageValue['type']);
            $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
            $source = $createFun(Yii::$app->basePath . '/..'.$image);
            //创建缩略图
            if ($type != 'gif' && function_exists('imagecreatetruecolor'))
                $thumb = imagecreatetruecolor($width, $height);
            else
                $thumb = imagecreate($width, $height);

            imagefill($thumb, 0, 0, imagecolorallocate($thumb, 255, 255, 255));
            imagecopyresampled($thumb, $source, 0, 0, $x, $y, $width, $height, $w, $h);

            $thumbname = $thumbname ? $thumbname : $image . '_' . $width . 'x' . $height . strrchr($image,'.');
            $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
            /*$imageFun($thumb, Yii::$app->basePath . '/..'. $thumbname, $quality);//对部分图片生成失败*/
            $imageFun($thumb, Yii::$app->basePath . '/..'. $thumbname, $quality);
            imagedestroy($thumb);
            imagedestroy($source);
            return $thumbname;
        } catch (Exception $ex) {
            return false;
        }
    }
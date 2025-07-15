<?php
// Upload item image (Controller)
namespace Item\Images\SetImage;

class Upload extends Model {
    public $itemID;
    public $altTag;
    public $caption;
    public $image;

    public function __construct($itemID, $altTag, $caption, $image) {
        $this->itemID = $itemID;
        $this->altTag = $altTag;
        $this->caption = $caption;
        $this->image = $image;
    }

    // upload Image Resize and Duplicate
    public function process() {

        // validate ID
        if ($this->validateID()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        define ("MAX_SIZE","4000");

        $size=filesize($this->image['tmp_name']);
		if ($size > MAX_SIZE*1024) {
            header("location: " . pageURL(true,true) . "action=itemImgList&itemID=" . $this->itemID . "&error=2"); // file size is too big
            exit();
		}

        $file = $this->image['tmp_name'];
        $props = getimagesize($file);
        $imgType = $props[2];

        if (($imgType == IMAGETYPE_JPEG) || ($imgType == IMAGETYPE_GIF) || ($imgType == IMAGETYPE_PNG) || ($imgType == IMAGETYPE_WEBP)) {
            $width = $props[0];
            $height = $props[1];
            $imgName = date("YmdHis");

            $resizedWidth=1000;
            $resizedHeight=round(($height/$width)*$resizedWidth);

            $thumbWidth=150;
            $thumbHeight=round(($height/$width)*$thumbWidth);

            if ($imgType == IMAGETYPE_JPEG) {
                $imgName = $imgName . ".jpg";
                $layer = imagecreatetruecolor($resizedWidth, $resizedHeight);
                imagecopyresampled($layer, imagecreatefromjpeg($file), 0, 0, 0, 0, $resizedWidth, $resizedHeight, $width, $height);
                imagejpeg($layer, "itemImages/resized_" . $imgName);

                $layer = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($layer, imagecreatefromjpeg($file), 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                imagejpeg($layer, "itemImages/thumb_" . $imgName);

            } else if ($imgType == IMAGETYPE_GIF) {
                $imgName = $imgName . ".gif";
                $layer = imagecreatetruecolor($resizedWidth, $resizedHeight);
                imagecopyresampled($layer, imagecreatefromgif($file), 0, 0, 0, 0, $resizedWidth, $resizedHeight, $width, $height);
                imagegif($layer, "itemImages/resized_" . $imgName);

                $layer = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($layer, imagecreatefromgif($file), 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                imagegif($layer, "itemImages/thumb_" . $imgName);

            } else if ($imgType == IMAGETYPE_PNG) {
                $imgName = $imgName . ".png";
                $layer = imagecreatetruecolor($resizedWidth, $resizedHeight);
                imagecopyresampled($layer, imagecreatefrompng($file), 0, 0, 0, 0, $resizedWidth, $resizedHeight, $width, $height);
                imagepng($layer, "itemImages/resized_" . $imgName);

                $layer = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($layer, imagecreatefrompng($file), 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                imagepng($layer, "itemImages/thumb_" . $imgName);

            } else if ($imgType == IMAGETYPE_WEBP) {
                $imgName = $imgName . ".webp";
                $layer = imagecreatetruecolor($resizedWidth, $resizedHeight);
                imagecopyresampled($layer, imagecreatefromwebp($file), 0, 0, 0, 0, $resizedWidth, $resizedHeight, $width, $height);
                imagewebp($layer, "itemImages/resized_" . $imgName);

                $layer = imagecreatetruecolor($thumbWidth, $thumbHeight);
                imagecopyresampled($layer, imagecreatefromwebp($file), 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                imagewebp($layer, "itemImages/thumb_" . $imgName);
            }

            if ($this->set($imgName)) {
                header("location: " . pageURL(true,true) . "action=itemImgList&itemID=" . $this->itemID);
            }

        } else {
            header("location: " . pageURL(true,true) . "action=itemImgList&itemID=" . $this->itemID . "&error=3"); // file is not an allowed file type
            exit();
        }

        unset($file, $props, $imgType, $width, $height, $imgName, $resizedWidth, $resizedHeight, $thumbWidth, $thumbHeight, $layer);
    }

    // Model
    private function set($imgName) {
        return $this->query($imgName);
    }

    // validate ID
    private function validateID() {
        if (!is_numeric($this->itemID)) {
            return true;
        }
    }
}
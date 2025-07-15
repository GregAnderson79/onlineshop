<?php 
use \Items\Item\Images\SetImage\Upload;
use \Items\Item\Images\ImageName\GetName;
use \Items\Item\Images\DeleteImage\Delete;
use \Items\Item\Images\Main\SetMain;
 
 // upload image
if ($action == "uplItemImg") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((isset($_GET["itemID"])) && (is_array($_FILES))) {
            $itemID = htmlspecialchars($_GET["itemID"]);
            $altTag = htmlspecialchars($_POST["altTag"]);
            $caption = htmlspecialchars($_POST["caption"]);
            $image = $_FILES['image'];

            $upload = new Upload($itemID, $altTag, $caption, $image);
            $upload->process();
        }

        unset($itemID, $altTag, $caption, $image, $upload);
    }
}

// delete item image
if ($action == "delItemImg") {
    if (isset($_GET["imgID"]) && isset($_GET["itemID"])) {
        $imgID = htmlspecialchars($_GET["imgID"]);
        $itemID = htmlspecialchars($_GET["itemID"]);

        $imgName = new GetName($imgID);
        $delImg = $imgName->imageName();

        $deleteItemImg = new Delete($imgID, $itemID, $delImg);
        $deleteItemImg->process();

        unset($imgID, $itemID, $imgName, $delImg, $deleteItemImg);
    }
}

// set image to main
if ($action == "setMainItemImg") {
    if (isset($_GET["imgID"]) && isset($_GET["itemID"])) {
        $imgID = htmlspecialchars($_GET["imgID"]);
        $itemID = htmlspecialchars($_GET["itemID"]);

        $setImgMain = new SetMain($imgID, $itemID);
        $setImgMain->process();

        unset($imgID, $itemID, $setImgMain);
    }
}
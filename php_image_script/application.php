<?php

/*
** Ayman Azm
** PHP Images Compressor Application
** Version 2.0
** OOP Based
*/

/** Image Processing Class **/
class IMAGEPROCESS {

    private $ImgName;                   // Image Name Property
    private $ImgFile;                   // Image File Property
    private $ImgSize;                   // Image Size Property
    private $ImgExt;                    // Image Extension Property
    private $Ratio;                     // Image Compress Ratio Property
    private static $Size = 10000000;    // Static Max Size

    /** Static Array of Images Supported Extensions **/
    private static $ExtList = ['png','PNG','jpg','JPG','jpeg','JPEG'];

    /** Construct Method (Initialize) **/
    public function __construct($REQUEST) {
        if ($REQUEST == 'POST'): // Check if Request Method is POST

            /** Set Properties to Incoming Image File Data **/
            $this->ImgName = $_FILES['img_to_compress']['name'];    
            $this->ImgFile = $_FILES['img_to_compress']['tmp_name'];
            $this->ImgSize = $_FILES['img_to_compress']['size'];
            $this->Ratio   = $_POST['ratio'];
            $this->ImgExt  = pathinfo($this->ImgName, PATHINFO_EXTENSION);

            /** Call Validate Image Method **/
            $this->ValidateImage();
        endif;
    }

    /** Process Image Method **/
    private function ProcessImage($ImageToBeProcessed) {
        header('Content-Type: image/jpeg');                 // Set header type to Image
        imagejpeg($ImageToBeProcessed, null, $this->Ratio); // Compress Image And Return It
        imagedestroy($ImageToBeProcessed);                  // Unset The Image From Memory (RAM)
    }

    /** Validate Image Method **/
    private function ValidateImage() {
        if ($this->ImgSize > self::$Size):                                  // Check Image Size
            echo 'Image File is Too Large! ';                               // Echo Error Message
            echo '<a href="../index.php"><button>Click Here To Back</button></a>';
            return false;
        elseif (!in_array($this->ImgExt, self::$ExtList)):                  // Check Image Extension
            echo 'File is Not Image, Please Select a Valid Image File ';    // Echo Error Message
            echo '<a href="../index.php"><button>Click Here To Back</button></a>';
            return false;
        else:
            if(!empty($this->ImgFile)):                                     // Check if Image Uploaded
                $ImgType = getimagesize($this->ImgFile);                    // Get Image Type
                $ReadyImg;                                                  // Declare Ready Image
                if ($ImgType['mime'] == 'image/jpeg'):                      // if JPEG
                    $ReadyImg = imagecreatefromjpeg($this->ImgFile);        // Make From JPEG
                    $this->ProcessImage($ReadyImg);                         // Call Process Image Method
                elseif ($ImgType['mime'] == 'image/png'):                   // if PNG
                    $ReadyImg = imagecreatefrompng($this->ImgFile);         // Make From PNG
                    $this->ProcessImage($ReadyImg);                         // Call Process Image Method
                else:
                    echo 'Something Went Error Please Try Again! ';         // Echo Error Message
                    echo '<a href="../index.php"><button>Click Here To Back</button></a>';
                    return false;
                endif;
            endif;
        endif;
    }

}

/** Instantiate New Image Processing Class **/
$IMAGEPROCESSOR = new IMAGEPROCESS($_SERVER['REQUEST_METHOD']);

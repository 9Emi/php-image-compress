<?php

/*
** Ayman Azm
** PHP Images Compressor Application
** Version 2.5
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

    /** Static Arrray of Error Messages **/
    private static $ErrorList = [
        'NotValid'  => 'file is not an image please select a valid image file',
        'LargeFile' => 'image file is too large',
        'EmptyFile' => 'image field can\'t be empty',
        'ErrorFile' => 'something went error while processing the image'
    ];

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
        header('Content-Disposition: Attachment;filename=compressed-img.jpg'); // force image download
        header('Content-Type: image/jpeg');                 // Set header type to Image
        imagejpeg($ImageToBeProcessed, null, $this->Ratio); // Compress Image And Return It
        imagedestroy($ImageToBeProcessed);                  // Unset Image From Memory (RAM)
    }

    /** Validate Image Method **/
    private function ValidateImage() {
        if ($this->ImgSize > self::$Size):                                  // Check Image Size
            $this->MessageTemplate(self::$ErrorList['LargeFile']);          // Call Template Method
            return false;                                                   // Return Nothing
        else:                                                               // if Size is ok
            if($this->ImgName == null):                                     // Check if Image Uploaded
               $this->MessageTemplate(self::$ErrorList['EmptyFile']);       // Call Template Method
               return false;                                                // Return Nothing
            else:                                                           // if Upload is ok
                if (in_array($this->ImgExt, self::$ExtList)):               // Check Image Extension
                    $this->PrepareImage();                                  // Call Prepare Method
                else:                                                       // if Not an Image
                    $this->MessageTemplate(self::$ErrorList['NotValid']);   // Call Template Method
                    return false;                                           // Return Nothing
                endif; 
            endif;
        endif;
    }

    /** Prepare Image Mrthod **/
    private function PrepareImage() {
        $ImgType = getimagesize($this->ImgFile);                    // Get Image Type
        $ReadyImg;                                                  // Declare Ready Image
        if ($ImgType['mime'] == 'image/jpeg'):                      // if JPEG
            $ReadyImg = imagecreatefromjpeg($this->ImgFile);        // Make From JPEG
            $this->ProcessImage($ReadyImg);                         // Call Process Image Method
        elseif ($ImgType['mime'] == 'image/png'):                   // if PNG
            $ReadyImg = imagecreatefrompng($this->ImgFile);         // Make From PNG
            $this->ProcessImage($ReadyImg);                         // Call Process Image Method
        else:                                                       // if Something Goes Wrong
            $this->MessageTemplate(self::$ErrorList['ErrorFile']);  // Call Template Method
            return false;                                           // Return Nothing
        endif;
    }

    /** Message Template Method **/
    private function MessageTemplate($MessageToThrow) {
        /** store css and html in variables **/

        /** Div CSS **/
        $DivCss = '
        background-color:#f1f1f1;
        border:1px solid #CCC;
        border-radius:5px;
        padding:30px 20px;
        font-family:tahoma,sans-serif;
        width:80vw;
        margin:208px auto;
        text-align:center;
        color:#f00';
        
        /** Button CSS **/
        $BtnCss = '
        background-color:#8a00b9;
        color:#FFF;
        cursor:pointer;
        border-style:none;
        padding:10px;
        border-radius:5px';

        /** Button HTML **/
        $BtnHtml = '<a href="../index.php"><button style="'.$BtnCss.'">Click Here To Back</button></a>';

        /** Full HTML Marjup **/
        $HtmlMarkup = '<div style="'.$DivCss.'"><h2>'.$MessageToThrow.'</h2>'.$BtnHtml.'</div>';

        /** Echo the template **/
        echo $HtmlMarkup;
    }

}

/** Instantiate New Image Processing Class **/
$IMAGEPROCESSOR = new IMAGEPROCESS($_SERVER['REQUEST_METHOD']);

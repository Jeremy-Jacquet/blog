<?php

namespace App\src\constraint;

class ImageConstraint
{
    const IMAGE_EXTENSIONS = ['jpg','gif','png','jpeg'];
    private $infosImg = array();

    public function checkDirectory($directory)
    {
        if(!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
    }

    public function checkImageTrue($file){
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $file['tmp_name']);
        finfo_close($fileInfo);
        if(strpos($mimeType, 'image/') !== 0) {
            return "Le fichier n'est pas une image.";
        }
    }

    public function checkName($file)
    {
        if(empty($file['name'])) {
            return "Le nom de votre image n'est pas reconnu.";
        }
    }

    public function checkExtension($file)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(!in_array(strtolower($extension), self::IMAGE_EXTENSIONS)) {
            return "L'extension de l'image n'est pas reconnue.";
        }
    }

    public function checkImageSize($file, $sizeMax, $heightMax, $widthMax)
    {
        $this->infosImg = getimagesize($file['tmp_name']);
        if(filesize($file['tmp_name']) >= $sizeMax) {
            return "Les dimensions de l'image ne sont pas supportées.";
        }
        /*
        if(!($this->infosImg[0] <= $widthMax) 
        OR !($this->infosImg[1] <= $heightMax) 
        OR !(filesize($file['tmp_name']) <= $sizeMax)) {
            return "Les dimensions de l'image ne sont pas supportées.";
        }
        */
    }

    public function checkError($file)
    {
        if(isset($file['error']) AND $file['error'] !== UPLOAD_ERR_OK) {
            return "Une erreur est survenue.";
        }
    }

}

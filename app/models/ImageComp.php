<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 16/08/2019
 * Time: 17:00
 */
class ImageComp
{
    private $newWidth;
    private $newHeight;
    private $jpgQuality;
    private $log;
    public function __construct()
    {
        $this->newWidth = 850;
        $this->newHeight = 850;
        $this->jpgQuality = 100;
        $this->log = new Log();
    }

    /**
     * Funcion para redimensionar imagenes
     *
     * @param string $origin Imagen origen en el disco duro ($_FILES["image1"]["tmp_name"])
     * @param string $destino Imagen destino en el disco duro ($destino=tempnam("tmp/","tmp");)
     * @return boolean true = Se ha redimensionada|false = La imagen es mas pequeña que el nuevo tamaño
     */

    /*integer $newWidth Anchura máxima de la nueva imagen
    integer $newHeight Altura máxima de la nueva imagen
    integer $jpgQuality (opcional) Calidad para la imagen jpg*/
    function redimensionarImagen($origin,$destino,$savet)
    {
        try {
            // getimagesize devuelve un array con: anchura,altura,tipo,cadena de
            // texto con el valor correcto height="yyy" width="xxx"
            $datos=getimagesize($origin);

            // comprobamos que la imagen sea superior a los tamaños de la nueva imagen
            if($datos[0]>$this->newWidth || $datos[1]>$this->newHeight)
            {
                // creamos una nueva imagen desde el original dependiendo del tipo
                if($datos[2]==1)
                    $img=imagecreatefromgif($origin);
                if($datos[2]==2)
                    $img=imagecreatefromjpeg($origin);
                if($datos[2]==3)
                    $img=imagecreatefrompng($origin);

                // Redimensionamos proporcionalmente
                if(rad2deg(atan($datos[0]/$datos[1]))>rad2deg(atan($this->newWidth/$this->newHeight)))
                {
                    $anchura=$this->newWidth;
                    $altura=round(($datos[1]*$this->newWidth)/$datos[0]);
                }else{
                    $altura=$this->newHeight;
                    $anchura=round(($datos[0]*$this->newHeight)/$datos[1]);
                }

                // creamos la imagen nueva
                $newImage = imagecreatetruecolor($anchura,$altura);

                // redimensiona la imagen original copiandola en la imagen
                imagecopyresampled($newImage, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

                // guardar la nueva imagen redimensionada donde indicia $destino
                if($datos[2]==1)
                    imagegif($newImage,$destino);
                if($datos[2]==2)
                    imagejpeg($newImage,$destino,$this->jpgQuality);
                if($datos[2]==3)
                    imagepng($newImage,$destino);

                // eliminamos la imagen temporal
                imagedestroy($newImage);

                // Si savet es "true", elimina la imagen original
                if(!$savet){
                    unlink($origin);
                }

                return true;
            }
            return false;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            return false;
        }
    }
}
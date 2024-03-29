<?php

/*
 */

namespace Plugin\ImageCompress\Entity;

use Eccube\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ImageCompress.
 *
 * @ORM\Table(name="plg_image_compress")
 * @ORM\Entity(repositoryClass="Plugin\ImageCompress\Repository\ImageCompressRepository")
 */
class ImageCompress
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", nullable=false, options={"default":false})
     */
    private $enable=false;

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string",length=63, nullable=false)
     */
    private $api_key;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getEnable.
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * set enable.
     *
     * @param boolean $enable
     *
     * @return $this
     */
    public function setEnable($enable = false)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * getApiKey.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * set Api Key.
     *
     * @param string $api_key
     *
     * @return $this
     */
    public function setApiKey($api_key = null)
    {
        $this->api_key = $api_key;

        return $this;
    }

    /**
     * 実行可能かチェック
     *
     * @return boolean
     */
    public function isDoable(){
        if(! $this->getEnable()) return false;
        if(! $this->getApiKey()) return false;

        return true;
    }

    /**
     * @return string
     */
    public function getApiHeaderValue(){
        $api_key = base64_encode('api:'.$this->getApiKey());
        return $api_key;
    }

    /**
     * @return boolean
     */
    public function isEnableExt($file_name){
       if(preg_match("/\.([\w]+)$/",$file_name,$regs)){
           $ext = $regs[1];
       } else {
           return false;
       }

       $ext = strtolower($ext);
       switch($ext){
           case 'jpg':
           case 'jpeg':
           case 'png':
               return true;
       }
       return false;
    }
}

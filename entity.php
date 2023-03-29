<?php

class entity
{
    public $name;
    public $entity_id;
    public $reg_auth;
    public $dsc, $dn, $sn;
    public $pp;
    public $login_link;
    public $logo;
    public $org = array();
    public $status;
    public $ls_date;

    public function __construct($n, $id, $reg)
    {
        $this->name = $n;
        $this->entity_id = $id;
        $this->reg_auth = $reg;
    }


    public function setDescription ($a, $b, $c){
        $this->dsc = $a;
        $this->dn = $b;
        $this->sn = $c;
    }

    public function setPP($p){
        $this->pp = $p;
    }

    public function setLogin($l){
        $this->login_link = $l;
    }

    public function setLogo($url){
        $this->logo = $url;
    }

    public function setOrg($o){
        $this->org = $o;
    }


    public function showImage(){
        ob_start();
        imagejpeg($this->logo, NULL, 100);
        $rawImage = ob_get_clean();
        echo "<img src='data:image/jpeg;base64,".base64_encode($rawImage)."/>";

    }

    public function printData(){
        echo "<br><b> Entity ID: </b>".$this->entity_id."<br>";
        echo "<br><b> Name: </b>".$this->name."<br>";
        echo "<br><b> Federation: </b>".$this->reg_auth."<br>";
        echo "<br><b> Login Link: </b>".$this->login_link."<br>";
        echo "<br><b> Descriptions: </b><br>DSC: ".$this->dsc."<br>DN: ".$this->dn."<br>SN: ".$this->sn."<br>";
        echo "<br><b> Privacy Policy: </b>".$this->pp."<br>";
        echo "<br><b> Organization: </b><br>Name: ".$this->org['name']."<br>Display Name: ".$this->org['displayname']."<br>Url: ".$this->org['url']."<br>";
        echo "<b> Logo: </b>";
        $this->showImage();
        echo "<br><br>";
    }

}
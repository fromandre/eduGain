<?php

class entity
{
    public $entity_id;
    public $reg_auth;
    public $name;
//    public $pp;
//    public $login_link;
//    public $logo;
    public $org = array();
    private $logo64;

    public function __construct($id)
    {
        $this->entity_id = $id;
    }


    public function setName ($name){
        $this->name = $name;
    }

//    public function setLogin($lPath){
//
//    }

//    public function setLogo($logoPath){
//        if (!empty($logoPath)) {
//            if (isset($logoPath['en'])) $this->logo = base64_encode(file_get_contents($logoPath['en']['value']));
//            else if (isset($logoPath[0]['value'])) $this->logo = base64_encode(file_get_contents($logoPath[0]['value']));
//        } else $this->logo = "No Logo";
//    }

    public function setOrg($orgName, $orgUrl){
        array_push($this->org, $orgName);
        array_push($this->org, $orgUrl);
    }


//    public function showImage(){
//        $imageData = imagecreatefromstring(file_get_contents($this->logo));
//        echo '<img src="data:image/png;base64,'.$imageData.'>';
//    }

//    public function printData(){
//        echo "<br><b> Entity ID: </b>".$this->entity_id;
//        echo "<br><b> Federation: </b>".$this->reg_auth;
//        echo "<br><b> Login Link: </b>".$this->login_link;
//        echo "<br><b> Descriptions: </b><br>DSC: ".$this->dsc."<br>DN: ".$this->dn."<br>SN: ".$this->sn;
//        echo "<br><b> Privacy Policy: </b>".$this->pp;
//        echo "<br><b> Organization: </b><br>Name: ".$this->org['name']."<br>Display Name: ".$this->org['displayname']."<br>Url: ".$this->org['url'];
//        echo "<br><b> Logo: </b>";
//        $this->showImage();
//        echo "<br><br>";
//    }
}
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

    public function __construct($n, $id, $reg)
    {
        $this->name = $n;
        $this->entity_id = $id;
        $this->reg_auth = $reg;
        $e_data = json_decode(file_get_contents(SP_ENTITY_DETAILS.$this->entity_id), true);
        $this->setDescription($e_data['roles']['SPSSODescriptor']);
        $this->setLogo($e_data['roles']['SPSSODescriptor']['logo']);
        $this->setLogin($e_data['roles']['SPSSODescriptor']['requestinitiator'][0]);
        $this->setPP($e_data['roles']['SPSSODescriptor']['PP']);
        $this->setOrg($e_data['org']);
        $this->setLogo($e_data['roles']['SPSSODescriptor']['logo']);
    }


    public function setDescription ($dscPath){
        if (!empty($dscPath['DSC'])) {
            if (isset($dscPath['DSC']['en'])) $a = $dscPath['DSC']['en'];
            else $a = $dscPath['DSC'][0];
        }

        if (!empty($dscPath['DN'])) {
            if (isset($dscPath['DN']['en'])) $b= $dscPath['DN']['en'];
            else $b = $dscPath['DN'][0];
        }

        if (!empty($dscPath['SN'])) {
            if (isset($dscPath['SN']['en'])) $c = $dscPath['SN']['en'];
            else $c = $dscPath['SN'][0];
        }

        $this->dsc = $a;
        $this->dn = $b;
        $this->sn = $c;
    }

    public function setPP($ppPath){
        if (isset($ppPath['en'])) $this->pp = $ppPath['en'];
        else $this->pp = $ppPath[0];
    }

    public function setLogin($lPath){
        if (isset($lPath)) {
            $this->login_link = $lPath;
        }
    }

    public function setLogo($logoPath){
        if (!empty($logoPath)) {
            if (isset($logoPath['en'])) $this->logo = $logoPath['en']['value'];
            else $this->logo = $logoPath[0]['value'];
        } else $this->logo = "No Logo";
    }

    public function setOrg($oPath){
        if (isset($oPath['en'])) $this->org = $oPath['en'];
        else $this->org = $oPath[0];
    }


    public function showImage(){
        $img = imagecreatefromstring(file_get_contents($this->logo));
        ob_start();
        imagejpeg($img, NULL, 100);
        $rawImageBytes = ob_get_clean();
        echo "<img src='data:image/jpeg;base64,".base64_encode($rawImageBytes)."/>";
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
<?php

class entity
{
    public $name;
    public $entity_id;
    public $dsc, $dn, $sn;
    public $login_link;
    public $logo;
    public $reg_auth;
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

    public function setLogin($l){
        $this->login_link = $l;
    }

//    public function setLogo(){
//    }

    public function printData(){
        echo "<br><b> Entity ID: </b>".$this->entity_id."<br>";
        echo "<br><b> Name: </b>".$this->name."<br>";
        echo "<br><b> Federation: </b>".$this->reg_auth."<br>";
        echo "<br><b> Login Link: </b>".$this->login_link."<br>";
        echo "<br><b> Descriptions: </b><br>DSC: ".$this->dsc."<br>DN: ".$this->dn."<br>SN: ".$this->sn."<br>";
        echo "<br><br>";
    }
}
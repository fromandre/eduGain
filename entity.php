<?php

class entity
{
    public $name;
    public $entity_id;
    public $dsc, $dn, $sn;
    public $login_link;
//    public $logo;
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
        var_dump($this->name, $this->entity_id, $this->reg_auth, $this->login_link, $this->dn);
    }
}
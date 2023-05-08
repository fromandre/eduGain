<?php
include("entity.php");
error_reporting(E_ALL ^ E_NOTICE);

function searchLocalXML()
{
    $sp = array();
    $xml_parse = json_encode(simplexml_load_file('services.xml'));
    $xml = json_decode($xml_parse, true);
    foreach ($xml as $value){
        foreach ($value as $v){
            if (isset($v["SPSSODescriptor"])) {
                $tmp_e = $v["@attributes"]["entityID"];
//                echo json_encode($v)."<br><br><br>";
                if (isset($v["SPSSODescriptor"]["AttributeConsumingService"]["ServiceName"])) {
                    $tmp_en = $v["SPSSODescriptor"]["AttributeConsumingService"]["ServiceName"];
                }				else{
                    $tmp_en = $v["SPSSODescriptor"]["AttributeConsumingService"]["ServiceDescription"];
                }
                if (isset($v["Organization"]["OrganizationDisplayName"])) $tmp_orgn = $v["Organization"]["OrganizationDisplayName"];
                if (isset($v["Organization"]["OrganizationURL"])) $tmp_orgl = $v["Organization"]["OrganizationURL"];
                $tmp = new entity($tmp_e);
                $tmp->setName($tmp_en);
                $tmp->setOrg($tmp_orgn, $tmp_orgl);
                array_push($sp, $tmp);
            }
        }

    }
    echo json_encode($sp);
}

searchLocalXML();



















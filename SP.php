<?php
include("entity.php");

//error_reporting(E_ALL ^ E_NOTICE);

//Inserisco endpoint dell'API di eduGain in due costanti
const SP_LIST_ENTITIES_JSON = "https://technical.edugain.org/api.php?action=list_entities&format=default&type=2";
const SP_ENTITY_DETAILS = "https://technical.edugain.org/api.php?action=show_entity_details&e_id=";
//const SP_SHOWENTITY_XML = "https://technical.edugain.org/api.php?action=show_entity&e_id=";


function searchByApi(){
    //Estraggo l'array associativo ed eseguo un ciclo for su tutti i suoi elementi
    $results = json_decode(file_get_contents(SP_LIST_ENTITIES_JSON), true);
    $data = array();

    foreach ($results as $result) {
        $e_id =  $result[0]['entityid'];
        $e_regauth = $result[0]['regauth'];
        $e_name = $result[0]['e_displayname'];
        //Creo la nuova entità
        //Al momento della creazione il costruttore si occupa di interrogare l'API per i restanti dati
        $tmp_entity = new entity($e_name, $e_id, $e_regauth);
        //Inserisco l'elemento entità all'interno di un array
        array_push($data, $tmp_entity);
    }
    //Al termine del ciclo restituisco il json contenente le entità
    echo json_encode($data);
}


//function searchByXML(){
//    $results = json_decode(file_get_contents(SP_LIST_ENTITIES_JSON), true);
////    $data = array();
//    foreach ($results as $result){
//        $id = $result[0]['entityid'];
//        $xml = file_get_contents(SP_SHOWENTITY_XML.$id);
//        $xml_parse = simplexml_load_string($xml) or die ("Impossibile caricare");
//        $reg_auth = $xml_parse->EntityDescriptor->registrationAuthority;
//        echo $reg_auth;
//        echo "<br> <br> <br> <br>";
//
//    }
//}

searchByApi();

















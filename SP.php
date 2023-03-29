<?php
include("entity.php");

function checkLogo($logoPath){
    if (!empty($logoPath)) {
        if (isset($logoPath['en'])) return $logoPath['en']['value'];
        else return $logoPath[0]['value'];
    } else return "No Logo";
}

function checkDescription($dscPath){
    $descriptions = array();

    if (!empty($dscPath['DSC'])) {
        if (isset($dscPath['DSC']['en'])) array_push($descriptions, $dscPath['DSC']['en']);
        else array_push($descriptions, $dscPath['DSC'][0]);
    }

    if (!empty($dscPath['DN'])) {
        if (isset($dscPath['DN']['en'])) array_push($descriptions, $dscPath['DN']['en']);
        else array_push($descriptions, $dscPath['DN'][0]);
    }

    if (!empty($dscPath['SN'])) {
        if (isset($dscPath['SN']['en'])) array_push($descriptions, $dscPath['SN']['en']);
        else array_push($descriptions, $dscPath['SN'][0]);
    }

    return $descriptions;
}

error_reporting(E_ALL ^ E_NOTICE);
//Inserisco endpoint dell'API di eduGain in due costanti
const SP_LIST_ENTITIES = "https://technical.edugain.org/api.php?action=list_entities&format=default&type=2";
const SP_ENTITY_DETAILS = "https://technical.edugain.org/api.php?action=show_entity_details&e_id=";
//const SP_ENTITY_XML = "https://technical.edugain.org/api.php?action=show_entity&e_id=";
$sp = array();

//Estraggo l'array associativo ed eseguo un ciclo for su tutti i suoi elementi
$results = json_decode(file_get_contents(SP_LIST_ENTITIES), true);

//Per ogni elemento estraggo l'entity id e interrogo nuovamente il server per i dettagli
 foreach ($results as $result) {
    $e_id =  $result[0]['entityid'];
    $e_regauth = $result[0]['regauth'];
    $e_name = $result[0]['e_displayname'];
    $e_data = json_decode(file_get_contents(SP_ENTITY_DETAILS.$result[0]['entityid']), true);
    //Creo la nuova entità
    $tmp_entity = new entity($e_name, $e_id, $e_regauth);
    //Eseguo un controllo sui valori della descrizione per verificarne l'effettiva esistenza e richiamo il metodo setDescription
     $d = checkDescription($e_data['roles']['SPSSODescriptor']);
     $logo = checkLogo($e_data['roles']['SPSSODescriptor']['logo']);


     //Se esiste ed è referenziato un link di login richiamo il metodo setLogin della classe entity
     if (isset($e_data['roles']['SPSSODescriptor']['requestinitiator'][0])) {
         $tmp_entity->setLogin($e_data['roles']['SPSSODescriptor']['requestinitiator'][0]);
     }
    //Se esiste ed è referenziato il link alla Privacy Policy in lingua inglese lo salvo come proprietà dell'oggetto entità, altrimenti salvo il primo link disponibile
     if (isset($e_data['roles']['SPSSODescriptor']['PP']['en'])) $tmp_entity->setPP($e_data['roles']['SPSSODescriptor']['PP']['en']);
     else $tmp_entity->setPP($e_data['roles']['SPSSODescriptor']['PP'][0]);
     //Importo i dati relativi all'organizzazione
     if (isset($e_data['org']['en'])) $tmp_entity->setOrg($e_data['org']['en']);
     else $tmp_entity->setOrg($e_data['org'][0]);

     $tmp_entity->setDescription($d[0], $d[1], $d[2]);
     $tmp_entity->setLogo($logo);
     array_push($sp, $tmp_entity);
}


 foreach ($sp as $service) {
     $service->printData();
 }













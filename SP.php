<?php
include("entity.php");

//function a_to_csv($array, $filename = "exp.csv", $delimiter=";"){
//    $f = fopen("php://memory", "w");
//    foreach ($array as $line) {
//        fputcsv($f, $line, $delimiter);
//     }
//    fseek($f, 0);
//    header('Content-Type: text/csv');
//    header('Content-Disposition: attachment; filename="'.$filename.'";');
//    fpassthru($f);
//}

//function arraytoXML($json_arr, &$xml)
//{
//    foreach($json_arr as $key => $value)
//    {
//        if(is_int($key))
//        {
//            $key = 'Element '.$key;
//        }
//        if(is_array($value))
//        {
//            $label = $xml->addChild($key);
//            arrayToXml($value, $label);
//        }
//        else
//        {
//            $xml->addChild($key, $value);
//        }
//    }
//}

$sp = array();

//Inserisco endpoint dell'API di eduGain in due costanti
const SP_LIST_ENTITIES = "https://technical.edugain.org/api.php?action=list_entities&format=default&type=2";
const SP_ENTITY_DETAILS = "https://technical.edugain.org/api.php?action=show_entity_details&e_id=";
const SP_ENTITY_NAME = "https://technical.edugain.org/api.php?action=get_entity_name&format=print_r&e_id=";
const SP_ENTITY_XML = "https://technical.edugain.org/api.php?action=show_entity&e_id=";
//Estraggo l'array associativo ed eseguo un ciclo for su tutti i suoi elementi
$results = json_decode(file_get_contents(SP_LIST_ENTITIES), true);


//Per ogni elemento estraggo l'entity id e interrogo nuovamente il server per i dettagli
 foreach ($results as $result) {
    $e_id =  $result[0]['entityid'];
    $e_name = json_decode(file_get_contents(SP_ENTITY_NAME.$e_id, true));
    $xml=simplexml_load_string(file_get_contents(SP_ENTITY_XML.$e_name)) or die("Error: Cannot create object");
    $reg = $xml->Extension->RegistrationInfo->registrationAuthority;
//    $e_data = json_decode(file_get_contents(SP_ENTITY_DETAILS.$result[0]['entityid']), true);
//    $e_data = (object)$e_data;


    $tmp_entity = new entity($e_name, $e_id, $reg);
    print_r($tmp_entity);
    echo "<br><br>";

    echo "<br>Descrizione estesa: <br>";

    //Eseguo un controllo sui valori della descrizione per verificarne l'effettiva esistenza ed eventualmente per stampare quella disponibile
    if (!empty($e_data->roles['SPSSODescriptor']['DSC'])) {
        if (isset($e_data->roles['SPSSODescriptor']['DSC']['en'])) {
            echo $e_data->roles['SPSSODescriptor']['DSC']['en'];
            } else echo $e_data->roles['SPSSODescriptor']['DSC'][0];
    } else echo "No data";


     echo "<br>Descrizione DN: <br>";
     if (!empty($e_data->roles['SPSSODescriptor']['DN'])) {
         if (isset($e_data->roles['SPSSODescriptor']['DN']['en'])) {
             echo $e_data->roles['SPSSODescriptor']['DN']['en'];
         } else echo $e_data->roles['SPSSODescriptor']['DN'][0];
     } else echo "No data";

     echo "<br>Descrizione SN: <br>";
     if (!empty($e_data->roles['SPSSODescriptor']['SN'])) {
         if (isset($e_data->roles['SPSSODescriptor']['SN']['en'])) {
             echo $e_data->roles['SPSSODescriptor']['SN']['en'];
         } else echo $e_data->roles['SPSSODescriptor']['SN'][0];
     } else echo "No data";


     echo "<br>Link di login: <br>";
     if (isset($e_data->roles['SPSSODescriptor']['requestinitiator'][0])){
         echo $e_data->roles['SPSSODescriptor']['requestinitiator'][0];
     } else echo "Link non disponibile.";

}













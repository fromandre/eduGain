<?php

$sp = array(

);

const SP_LIST_ENTITIES = "https://technical.edugain.org/api.php?action=list_entities&format=default&type=2";
const SP_ENTITY_DETAILS = "https://technical.edugain.org/api.php?action=show_entity_details&e_id=";

$results = json_decode(file_get_contents(SP_LIST_ENTITIES), true);


 foreach ($results as $result) {
    $details = file_get_contents(SP_ENTITY_DETAILS.$result[0]['entityid']);

     $entity = array(
         'entity_id' => $result[0]['entityid'],
         'e_displayname' => $result[0]['e_displayname'],
     );
    array_push($sp, $entity);
}

 echo json_encode($sp);








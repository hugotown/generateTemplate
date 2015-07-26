<?php if (isset($id)) { echo json_encode($accountsContact, JSON_NUMERIC_CHECK); } else { echo json_encode($accountsContacts, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($contact, JSON_NUMERIC_CHECK); } else { echo json_encode($contacts, JSON_NUMERIC_CHECK); } ?>

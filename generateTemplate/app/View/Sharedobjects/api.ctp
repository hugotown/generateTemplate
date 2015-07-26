<?php if (isset($id)) { echo json_encode($sharedobject, JSON_NUMERIC_CHECK); } else { echo json_encode($sharedobjects, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($opportunitiesUser, JSON_NUMERIC_CHECK); } else { echo json_encode($opportunitiesUsers, JSON_NUMERIC_CHECK); } ?>

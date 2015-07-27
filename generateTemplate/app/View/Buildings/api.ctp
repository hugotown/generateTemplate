<?php if (isset($id)) { echo json_encode($building, JSON_NUMERIC_CHECK); } else { echo json_encode($buildings, JSON_NUMERIC_CHECK); } ?>

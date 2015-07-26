<?php if (isset($id)) { echo json_encode($accountUser, JSON_NUMERIC_CHECK); } else { echo json_encode($accountUsers, JSON_NUMERIC_CHECK); } ?>

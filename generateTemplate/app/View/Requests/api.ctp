<?php if (isset($id)) { echo json_encode($request, JSON_NUMERIC_CHECK); } else { echo json_encode($requests, JSON_NUMERIC_CHECK); } ?>

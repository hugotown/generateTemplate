<?php if (isset($id)) { echo json_encode($resource, JSON_NUMERIC_CHECK); } else { echo json_encode($resources, JSON_NUMERIC_CHECK); } ?>

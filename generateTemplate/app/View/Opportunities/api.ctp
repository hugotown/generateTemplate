<?php if (isset($id)) { echo json_encode($opportunity, JSON_NUMERIC_CHECK); } else { echo json_encode($opportunities, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($storeimportlog, JSON_NUMERIC_CHECK); } else { echo json_encode($storeimportlogs, JSON_NUMERIC_CHECK); } ?>

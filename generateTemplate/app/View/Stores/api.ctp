<?php if (isset($id)) { echo json_encode($store, JSON_NUMERIC_CHECK); } else { echo json_encode($stores, JSON_NUMERIC_CHECK); } ?>

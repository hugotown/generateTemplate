<?php if (isset($id)) { echo json_encode($orderPromissory, JSON_NUMERIC_CHECK); } else { echo json_encode($orderPromissories, JSON_NUMERIC_CHECK); } ?>

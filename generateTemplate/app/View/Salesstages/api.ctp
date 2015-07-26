<?php if (isset($id)) { echo json_encode($salesstage, JSON_NUMERIC_CHECK); } else { echo json_encode($salesstages, JSON_NUMERIC_CHECK); } ?>

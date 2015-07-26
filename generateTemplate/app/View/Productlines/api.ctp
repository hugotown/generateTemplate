<?php if (isset($id)) { echo json_encode($productline, JSON_NUMERIC_CHECK); } else { echo json_encode($productlines, JSON_NUMERIC_CHECK); } ?>

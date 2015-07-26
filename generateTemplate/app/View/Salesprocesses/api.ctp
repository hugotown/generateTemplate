<?php if (isset($id)) { echo json_encode($salesprocess, JSON_NUMERIC_CHECK); } else { echo json_encode($salesprocesses, JSON_NUMERIC_CHECK); } ?>

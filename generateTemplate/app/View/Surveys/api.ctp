<?php if (isset($id)) { echo json_encode($survey, JSON_NUMERIC_CHECK); } else { echo json_encode($surveys, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($employeeposition, JSON_NUMERIC_CHECK); } else { echo json_encode($employeepositions, JSON_NUMERIC_CHECK); } ?>

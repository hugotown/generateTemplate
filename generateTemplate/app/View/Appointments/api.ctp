<?php if (isset($id)) { echo json_encode($appointment, JSON_NUMERIC_CHECK); } else { echo json_encode($appointments, JSON_NUMERIC_CHECK); } ?>

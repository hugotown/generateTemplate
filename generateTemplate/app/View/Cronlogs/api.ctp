<?php if (isset($id)) { echo json_encode($cronlog, JSON_NUMERIC_CHECK); } else { echo json_encode($cronlogs, JSON_NUMERIC_CHECK); } ?>

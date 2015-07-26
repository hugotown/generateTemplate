<?php if (isset($id)) { echo json_encode($activity, JSON_NUMERIC_CHECK); } else { echo json_encode($activities, JSON_NUMERIC_CHECK); } ?>

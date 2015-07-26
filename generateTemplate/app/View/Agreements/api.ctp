<?php if (isset($id)) { echo json_encode($agreement, JSON_NUMERIC_CHECK); } else { echo json_encode($agreements, JSON_NUMERIC_CHECK); } ?>

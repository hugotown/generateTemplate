<?php if (isset($id)) { echo json_encode($dashboard, JSON_NUMERIC_CHECK); } else { echo json_encode($dashboards, JSON_NUMERIC_CHECK); } ?>

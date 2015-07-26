<?php if (isset($id)) { echo json_encode($activityProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($activityProducts, JSON_NUMERIC_CHECK); } ?>

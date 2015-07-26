<?php if (isset($id)) { echo json_encode($dashboardobject, JSON_NUMERIC_CHECK); } else { echo json_encode($dashboardobjects, JSON_NUMERIC_CHECK); } ?>

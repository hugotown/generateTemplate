<?php if (isset($id)) { echo json_encode($dashboardobjectGroup, JSON_NUMERIC_CHECK); } else { echo json_encode($dashboardobjectGroups, JSON_NUMERIC_CHECK); } ?>

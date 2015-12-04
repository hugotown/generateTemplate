<?php if (isset($id)) { echo json_encode($buildingspot, JSON_NUMERIC_CHECK); } else { echo json_encode($buildingspots, JSON_NUMERIC_CHECK); } ?>

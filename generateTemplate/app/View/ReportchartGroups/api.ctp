<?php if (isset($id)) { echo json_encode($reportchartGroup, JSON_NUMERIC_CHECK); } else { echo json_encode($reportchartGroups, JSON_NUMERIC_CHECK); } ?>

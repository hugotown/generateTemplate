<?php if (isset($id)) { echo json_encode($reportchart, JSON_NUMERIC_CHECK); } else { echo json_encode($reportcharts, JSON_NUMERIC_CHECK); } ?>

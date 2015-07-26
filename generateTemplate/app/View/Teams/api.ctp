<?php if (isset($id)) { echo json_encode($team, JSON_NUMERIC_CHECK); } else { echo json_encode($teams, JSON_NUMERIC_CHECK); } ?>

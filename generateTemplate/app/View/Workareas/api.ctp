<?php if (isset($id)) { echo json_encode($workarea, JSON_NUMERIC_CHECK); } else { echo json_encode($workareas, JSON_NUMERIC_CHECK); } ?>

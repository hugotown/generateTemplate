<?php if (isset($id)) { echo json_encode($workstation, JSON_NUMERIC_CHECK); } else { echo json_encode($workstations, JSON_NUMERIC_CHECK); } ?>

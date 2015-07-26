<?php if (isset($id)) { echo json_encode($group, JSON_NUMERIC_CHECK); } else { echo json_encode($groups, JSON_NUMERIC_CHECK); } ?>

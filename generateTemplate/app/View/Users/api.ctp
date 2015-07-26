<?php if (isset($id)) { echo json_encode($user, JSON_NUMERIC_CHECK); } else { echo json_encode($users, JSON_NUMERIC_CHECK); } ?>

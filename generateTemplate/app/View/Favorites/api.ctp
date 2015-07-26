<?php if (isset($id)) { echo json_encode($favorite, JSON_NUMERIC_CHECK); } else { echo json_encode($favorites, JSON_NUMERIC_CHECK); } ?>

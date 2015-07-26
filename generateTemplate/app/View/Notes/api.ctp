<?php if (isset($id)) { echo json_encode($note, JSON_NUMERIC_CHECK); } else { echo json_encode($notes, JSON_NUMERIC_CHECK); } ?>

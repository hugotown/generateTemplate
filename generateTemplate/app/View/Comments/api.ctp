<?php if (isset($id)) { echo json_encode($comment, JSON_NUMERIC_CHECK); } else { echo json_encode($comments, JSON_NUMERIC_CHECK); } ?>

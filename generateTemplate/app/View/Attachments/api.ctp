<?php if (isset($id)) { echo json_encode($attachment, JSON_NUMERIC_CHECK); } else { echo json_encode($attachments, JSON_NUMERIC_CHECK); } ?>

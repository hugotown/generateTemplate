<?php if (isset($id)) { echo json_encode($mail, JSON_NUMERIC_CHECK); } else { echo json_encode($mails, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($address, JSON_NUMERIC_CHECK); } else { echo json_encode($addresses, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($quote, JSON_NUMERIC_CHECK); } else { echo json_encode($quotes, JSON_NUMERIC_CHECK); } ?>

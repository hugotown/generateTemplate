<?php if (isset($id)) { echo json_encode($payment, JSON_NUMERIC_CHECK); } else { echo json_encode($payments, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($orderPayment, JSON_NUMERIC_CHECK); } else { echo json_encode($orderPayments, JSON_NUMERIC_CHECK); } ?>

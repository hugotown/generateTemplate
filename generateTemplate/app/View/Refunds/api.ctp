<?php if (isset($id)) { echo json_encode($refund, JSON_NUMERIC_CHECK); } else { echo json_encode($refunds, JSON_NUMERIC_CHECK); } ?>

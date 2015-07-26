<?php if (isset($id)) { echo json_encode($order, JSON_NUMERIC_CHECK); } else { echo json_encode($orders, JSON_NUMERIC_CHECK); } ?>

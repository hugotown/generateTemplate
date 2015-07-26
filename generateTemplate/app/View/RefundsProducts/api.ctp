<?php if (isset($id)) { echo json_encode($refundsProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($refundsProducts, JSON_NUMERIC_CHECK); } ?>

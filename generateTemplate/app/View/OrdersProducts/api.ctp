<?php if (isset($id)) { echo json_encode($ordersProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($ordersProducts, JSON_NUMERIC_CHECK); } ?>

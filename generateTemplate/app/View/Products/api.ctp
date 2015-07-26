<?php if (isset($id)) { echo json_encode($product, JSON_NUMERIC_CHECK); } else { echo json_encode($products, JSON_NUMERIC_CHECK); } ?>

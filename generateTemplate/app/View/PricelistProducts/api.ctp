<?php if (isset($id)) { echo json_encode($pricelistProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($pricelistProducts, JSON_NUMERIC_CHECK); } ?>

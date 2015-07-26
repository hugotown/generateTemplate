<?php if (isset($id)) { echo json_encode($productsComponent, JSON_NUMERIC_CHECK); } else { echo json_encode($productsComponents, JSON_NUMERIC_CHECK); } ?>

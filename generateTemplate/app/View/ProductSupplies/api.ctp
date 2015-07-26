<?php if (isset($id)) { echo json_encode($productSupply, JSON_NUMERIC_CHECK); } else { echo json_encode($productSupplies, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($opportunityProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($opportunityProducts, JSON_NUMERIC_CHECK); } ?>

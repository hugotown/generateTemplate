<?php if (isset($id)) { echo json_encode($pricelist, JSON_NUMERIC_CHECK); } else { echo json_encode($pricelists, JSON_NUMERIC_CHECK); } ?>

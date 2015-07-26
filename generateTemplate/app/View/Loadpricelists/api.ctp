<?php if (isset($id)) { echo json_encode($loadpricelist, JSON_NUMERIC_CHECK); } else { echo json_encode($loadpricelists, JSON_NUMERIC_CHECK); } ?>

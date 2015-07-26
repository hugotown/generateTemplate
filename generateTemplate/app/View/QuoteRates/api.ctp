<?php if (isset($id)) { echo json_encode($quoteRate, JSON_NUMERIC_CHECK); } else { echo json_encode($quoteRates, JSON_NUMERIC_CHECK); } ?>

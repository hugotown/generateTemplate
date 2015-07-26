<?php if (isset($id)) { echo json_encode($quotesProduct, JSON_NUMERIC_CHECK); } else { echo json_encode($quotesProducts, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($agreementRate, JSON_NUMERIC_CHECK); } else { echo json_encode($agreementRates, JSON_NUMERIC_CHECK); } ?>

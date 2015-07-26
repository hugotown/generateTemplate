<?php if (isset($id)) { echo json_encode($opportunityRate, JSON_NUMERIC_CHECK); } else { echo json_encode($opportunityRates, JSON_NUMERIC_CHECK); } ?>

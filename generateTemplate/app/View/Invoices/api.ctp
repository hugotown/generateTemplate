<?php if (isset($id)) { echo json_encode($invoice, JSON_NUMERIC_CHECK); } else { echo json_encode($invoices, JSON_NUMERIC_CHECK); } ?>

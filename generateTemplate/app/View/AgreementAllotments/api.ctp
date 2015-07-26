<?php if (isset($id)) { echo json_encode($agreementAllotment, JSON_NUMERIC_CHECK); } else { echo json_encode($agreementAllotments, JSON_NUMERIC_CHECK); } ?>

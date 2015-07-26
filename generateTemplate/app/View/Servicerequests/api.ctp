<?php if (isset($id)) { echo json_encode($servicerequest, JSON_NUMERIC_CHECK); } else { echo json_encode($servicerequests, JSON_NUMERIC_CHECK); } ?>

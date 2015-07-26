<?php if (isset($id)) { echo json_encode($storeimportdetaillog, JSON_NUMERIC_CHECK); } else { echo json_encode($storeimportdetaillogs, JSON_NUMERIC_CHECK); } ?>

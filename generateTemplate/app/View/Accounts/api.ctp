<?php if (isset($id)) { echo json_encode($account, JSON_NUMERIC_CHECK); } else { echo json_encode($accounts, JSON_NUMERIC_CHECK); } ?>

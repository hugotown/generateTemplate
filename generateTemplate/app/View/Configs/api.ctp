<?php if (isset($id)) { echo json_encode($config, JSON_NUMERIC_CHECK); } else { echo json_encode($configs, JSON_NUMERIC_CHECK); } ?>

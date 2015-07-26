<?php if (isset($id)) { echo json_encode($family, JSON_NUMERIC_CHECK); } else { echo json_encode($families, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($loadplerror, JSON_NUMERIC_CHECK); } else { echo json_encode($loadplerrors, JSON_NUMERIC_CHECK); } ?>

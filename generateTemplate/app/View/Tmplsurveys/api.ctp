<?php if (isset($id)) { echo json_encode($tmplsurvey, JSON_NUMERIC_CHECK); } else { echo json_encode($tmplsurveys, JSON_NUMERIC_CHECK); } ?>

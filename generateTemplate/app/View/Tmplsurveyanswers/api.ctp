<?php if (isset($id)) { echo json_encode($tmplsurveyanswer, JSON_NUMERIC_CHECK); } else { echo json_encode($tmplsurveyanswers, JSON_NUMERIC_CHECK); } ?>

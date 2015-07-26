<?php if (isset($id)) { echo json_encode($tmplsurveysection, JSON_NUMERIC_CHECK); } else { echo json_encode($tmplsurveysections, JSON_NUMERIC_CHECK); } ?>

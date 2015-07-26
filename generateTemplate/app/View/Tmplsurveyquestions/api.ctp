<?php if (isset($id)) { echo json_encode($tmplsurveyquestion, JSON_NUMERIC_CHECK); } else { echo json_encode($tmplsurveyquestions, JSON_NUMERIC_CHECK); } ?>

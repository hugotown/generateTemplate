<?php if (isset($id)) { echo json_encode($surveyAnswer, JSON_NUMERIC_CHECK); } else { echo json_encode($surveyAnswers, JSON_NUMERIC_CHECK); } ?>

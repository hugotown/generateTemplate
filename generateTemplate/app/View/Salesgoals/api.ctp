<?php if (isset($id)) { echo json_encode($salesgoal, JSON_NUMERIC_CHECK); } else { echo json_encode($salesgoals, JSON_NUMERIC_CHECK); } ?>

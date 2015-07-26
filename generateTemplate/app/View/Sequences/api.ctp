<?php if (isset($id)) { echo json_encode($sequence, JSON_NUMERIC_CHECK); } else { echo json_encode($sequences, JSON_NUMERIC_CHECK); } ?>

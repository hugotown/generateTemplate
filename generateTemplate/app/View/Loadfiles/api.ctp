<?php if (isset($id)) { echo json_encode($loadfile, JSON_NUMERIC_CHECK); } else { echo json_encode($loadfiles, JSON_NUMERIC_CHECK); } ?>

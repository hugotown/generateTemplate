<?php if (isset($id)) { echo json_encode($poEntry, JSON_NUMERIC_CHECK); } else { echo json_encode($poEntries, JSON_NUMERIC_CHECK); } ?>

<?php if (isset($id)) { echo json_encode($reservation, JSON_NUMERIC_CHECK); } else { echo json_encode($reservations, JSON_NUMERIC_CHECK); } ?>

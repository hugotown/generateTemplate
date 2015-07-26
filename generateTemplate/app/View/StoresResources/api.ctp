<?php if (isset($id)) { echo json_encode($storesResource, JSON_NUMERIC_CHECK); } else { echo json_encode($storesResources, JSON_NUMERIC_CHECK); } ?>

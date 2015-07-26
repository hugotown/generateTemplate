<?php if (isset($id)) { echo json_encode($activityResource, JSON_NUMERIC_CHECK); } else { echo json_encode($activityResources, JSON_NUMERIC_CHECK); } ?>

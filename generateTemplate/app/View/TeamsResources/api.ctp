<?php if (isset($id)) { echo json_encode($teamsResource, JSON_NUMERIC_CHECK); } else { echo json_encode($teamsResources, JSON_NUMERIC_CHECK); } ?>

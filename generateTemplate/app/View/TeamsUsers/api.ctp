<?php if (isset($id)) { echo json_encode($teamsUser, JSON_NUMERIC_CHECK); } else { echo json_encode($teamsUsers, JSON_NUMERIC_CHECK); } ?>

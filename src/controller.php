<?php

// the model would be included here
// due to the small size of the project we decided to not overcomplicate it and didn't implement a model

// include database connection
include '../db_connector.php';

// change of views
$view = isset($_GET['view']) ? $_GET['view'] : '';

?>
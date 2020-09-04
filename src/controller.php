<?php

include '../model/board.class.php';

$view = isset($_GET['view']) ? $_GET['view'] : '';

//Change view
if (isset($_POST['conf'])) {
  $view = 'home';
}

//Change view, get and validate information
if (isset($_POST['save'])) {

}

?>
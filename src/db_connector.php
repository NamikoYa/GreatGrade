<?php
  $host = 'localhost'; // host
  $username = 'GGUser'; // username
  $password = 'GGPassword'; // password
  $database = 'db_greatgrade'; // database

  // connect to database
  $mysqli = new mysqli($host, $username, $password, $database);

  // error message in case connection fails
  if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
  }
?>
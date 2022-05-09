<?php
  $userPass = 'admin';
  $salt = '1652093345';
  $hashedPass = '$2y$10$RIPQsSyccgE3Fi2sVEJo1edrY7QFien9vqZKb4v0jc5WMPegw/EBy';
  var_dump(password_verify($userPass . $salt, $hashedPass));
?>
<?php
      $config = parse_ini_file('/var/www/private/config.ini');
      $con = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
      if (!$con) {
          echo "Error: Unable to connect to MySQL." . PHP_EOL;
          echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
          echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
      }
?>

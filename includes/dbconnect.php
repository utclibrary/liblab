<?php
      $config = parse_ini_file('/var/www/private/config.ini');
      $servername = $config['servername'];
      $username = $config['username'];
      $password = $config['password'];
      //if ($dbname === "LuptonDB"){
        $conLuptonDB = mysqli_connect($servername,$username,$password, 'LuptonDB');
        if (!$conLuptonDB) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
        }
      //}
      //if ($dbname === "Date"){
      $conDate = mysqli_connect($servername,$username,$password, 'Date');
      if (!$conDate) {
          echo "Error: Unable to connect to MySQL." . PHP_EOL;
          echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
          echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
      }
    //}
    $conLuptonDBLGS = mysqli_connect($servername,$username,$password, 'LuptonDB');
    if (!$conLuptonDBLGS) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
?>

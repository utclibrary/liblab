<?php
      $config = parse_ini_file('/var/www/private/config.ini');
      $servername = $config['servername'];
      $username = $config['username'];
      $password = $config['password'];
      //if ($dbname === "DBofDBs"){
        $conDBofDBs = mysqli_connect($servername,$username,$password, 'DBofDBs');
        if (!$conDBofDBs) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
        }
      //}
      //if ($dbname === "Dates"){
      $conDates = mysqli_connect($servername,$username,$password, 'Dates');
      if (!$conDates) {
          echo "Error: Unable to connect to MySQL." . PHP_EOL;
          echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
          echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
      exit;
      }
    //}
    $conDBofDBsLGS = mysqli_connect($servername,$username,$password, 'DBofDBs');
    if (!$conDBofDBsLGS) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
    $conLogin = mysqli_connect($servername,$username,$password, 'Login');
    if (!$conLogin) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
?>

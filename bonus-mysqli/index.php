<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MYSQLI [Bonus - Hotel]</title>
  </head>
  <body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "db_hotel";
    // Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn && $conn->connect_error) {
    echo "Errore: " . $conn->connect_error;
    }
    ?>

    <ul>

      <li>
        <h2>Lista Stanze</h2>
        <?php
        $sql = "SELECT room_number, floor FROM stanze";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "Stanza N. ". $row['room_number']. " piano: ".$row['floor'] . "<br>";
          }
        } elseif ($result) {
          echo "0 results";
        } else {
          echo "query error";
        }
         ?>
      </li>

      <li>
        <h2>Lista Ospiti in Prenotazioni</h2>
        <?php
        $sql = "SELECT name, lastname, prenotazione_id FROM prenotazioni_has_ospiti
        INNER JOIN ospiti ON prenotazioni_has_ospiti.ospite_id = ospiti.id";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "Nome: " . $row['name'] . " " . $row['lastname'] . "&nbsp;&nbsp; | &nbsp;&nbsp;";
            echo "Prenotazione Nr. : " . $row['prenotazione_id'];
            echo "<hr>";
          }
        } elseif ($result) {
          echo "0 results";
        } else {
          echo "query error";
        }
         ?>
      </li>

    </ul>

    <?php
    $conn->close();
     ?>

  </body>
</html>

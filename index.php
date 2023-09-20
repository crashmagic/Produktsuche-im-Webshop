<!DOCTYPE html>
<html>
<head>
    <title>Produktsuche im Webshop</title>
</head>
<body>
    <h1>Produktsuche im Webshop</h1>
    <form method="POST" action="">
        <input type="text" name="searchTerm" placeholder="Produktsuche eingeben">
        <input type="submit" name="search" value="Suchen">
    </form>

    <h1>Produktsuche nach Kategorien</h1>
    <label for="kategorie">Kategorie auswählen:</label>
    <select id="kategorie">

        <option value="1">Datenspeicher</option>
        <option value="2">Anzeigegeräte</option>
        <option value="3">Kameras</option>
        <option value="4">Drucker</option>
    </select>
    <button onclick="sucheProdukte()">Suchen</button>
    </form>
</body>
</html>

<?php
// Verbindung zur Datenbank herstellen
$serverName = "tcp:mysqlserver080923.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "mySampleDatabase",
    "Uid" => "hfh",
    "PWD" => "f5h743fc&!"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . sqlsrv_errors());
}

// Verarbeitung der Suchanfrage
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    
    // SQL-Abfrage vorbereiten und ausführen
    $query = "SELECT id,name,preis FROM dbo.Produkte WHERE name LIKE '%$searchTerm%'";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        die("SQL-Abfrage fehlgeschlagen: " . sqlsrv_errors());
    }

    // Produkte anzeigen
    $numRows = sqlsrv_num_rows($result);
 //   $numRows = LENGTH($result);


    if ($numRows !== 0) {
        echo "<p>$numRows Folgende Produkte wurden gefunden:</p>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<p>" . $row['name'] . " - Preis: " . $row['preis'] . "</p>";
        }
     }  
 	else {
        echo "Keine Produkte gefunden.";

 }


// ----------ab hier Abfrage nach Kategorien--------------------------------

//<html>
//<body>
//   <h1>Produktsuche nach Kategorien</h1>
//    <form method="POST" action="">
//        <input type="text" name="searchTerm" placeholder="Produktsuche eingeben">
//        <input type="submit" name="search" value="Suchen">
//    </form>
//</body>
//</html>

// Abfrage, um alle verfügbaren Kategorien abzurufen

$categoryQuery = "SELECT * FROM dbo.Kategorie";
$categoryResult = sqlsrv_query($conn, $categoryQuery);

if ($categoryResult === false) {
    die("Abfrage der Kategorien fehlgeschlagen: " . sqlsrv_errors());
}

// Verarbeitung der Suchanfrage

if (isset($_POST['kategorie'])) {
    $selectedCategory = $_POST['category'];



// SQL-Abfrage vorbereiten und ausführen, um Produkte nach ausgewählter Kategorie abzurufen
    $query = "SELECT * FROM dbo.Produkte WHERE kategorie_id = ?";
    $params = array($selectedCategory);
    $result = sqlsrv_query($conn, $query, $params);

    if ($result === false) {
        die("SQL-Abfrage fehlgeschlagen: " . sqlsrv_errors());
    }

    // Produkte anzeigen
    $numRows = sqlsrv_num_rows($result);

    if ($numRows > 0) {
        echo "<p>$numRows Produkte gefunden:</p>";
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            echo "<p>Produkt: " . $row['name'] . " - Preis: " . $row['preis'] . "</p>";
        }
    } else {
        echo "Keine Produkte in dieser Kategorie gefunden.";
    }

    // Verbindung schließen
    sqlsrv_close($conn);
}
}
?>


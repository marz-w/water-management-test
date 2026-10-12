<?php
    // -----------------------------------------------------------------------------
    // This page retrieves and displays every record from the "location" table.
    // The data is then shown in an HTML table so users can view the list of
    // locations stored in the database.
    // -----------------------------------------------------------------------------

    // Database connection settings.
    // These values tell PHP which MySQL server to connect to and which database
    // to use for the queries on this page.
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "watermanagement";

    // Create a connection to the MySQL database.
    // The mysqli class is used to connect to the database and run SQL queries.
    $conn = new mysqli($host, $username, $password, $database);

    // If the database connection fails, the script stops immediately.
    // This prevents the page from continuing in a broken state.
    if (!$conn) {
        die("Connection Failed!");
    }

    // SQL query that selects the important location fields from the database.
    // We choose the location id, the name, and the description so the table can
    // show a readable list of all locations.
    $sql_location = "select id, name, description from location";

    // Execute the query against the database and store the result object.
    // This result object contains the rows returned by the query and supports
    // methods such as num_rows and fetch_assoc().
    $result_location = $conn->query($sql_location);
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- The browser tab title identifies this page as the locations listing. -->
        <title>Locations</title>
    </head>
    <body style="display:grid;place-items:center">
        <!-- This heading explains what the user is seeing on this page. -->
        <h1>Locations List</h1>

        <?php
            // This condition checks whether the database query returned at least one row.
            // If rows exist, the table below will be rendered with those records.
            // If no rows exist, the table is still created, but it will be empty.
            if ($result_location->num_rows > 0)
        ?>
        <table border="1">
            <tr>
                <!-- These columns match the fields selected from the database. -->
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>

        <?php
            // Fetch each row one by one from the result set.
            // The loop continues until all rows in the query result have been read.
            while ($row = $result_location->fetch_assoc()):
        ?>
            <tr>
                <!-- htmlspecialchars() protects the value before printing it to the page.
                     This helps prevent HTML injection by converting special characters,
                     such as <, >, and &, into safe text representation. -->
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
            </tr>
        <?php endwhile; ?>
        </table>
    </body>
</html>

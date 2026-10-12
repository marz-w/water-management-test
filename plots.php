<?php
    // -----------------------------------------------------------------------------
    // This page loads plot information from the database and shows it in a table.
    // A plot is a land or property entry in the water management project, and each
    // one includes basic identification and geographic data for tracking usage.
    // -----------------------------------------------------------------------------

    // Connection settings used to access the local MySQL database.
    // The app needs these credentials before it can read any records.
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "watermanagement";

    // Open a new database connection.
    // The mysqli object will be used for all queries in this page.
    $conn = new mysqli($host, $username, $password, $database);

    // If the connection fails, stop processing the page.
    // This prevents displaying broken or incomplete data.
    if (!$conn) {
        die("Connection Failed!");
    }

    // SQL query for reading plot records.
    // The selected fields include the plot identifier, its name, geographic
    // coordinates, meter number, water rate, and the related location ID.
    $sql_plot = "select id, name, longitude, latitude, meter_no, water_rate, location_id from plots";

    // Execute the plot query and save the result set.
    // The result object contains all rows returned by the database.
    $result_plot = $conn->query($sql_plot);
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- This title appears in the browser tab and identifies the page as the plots listing. -->
        <title>Plots</title>
    </head>
    <body style="display:grid;place-items:center">
        <!-- Heading shown to the user at the top of the page. -->
        <h1>Plots List</h1>

        <?php
            // Determine whether there are records to display before rendering the table.
            // If data exists, the rows will be generated dynamically below.
            if ($result_plot->num_rows > 0)
        ?>
        <table border="1">
            <tr>
                <!-- These headers label the plot fields that are visible to the user. -->
                <th>ID</th>
                <th>Name</th>
                <th>Water Rate</th>
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>

        <?php
            // Loop through every row returned by the database.
            // Each row is stored in $row as an associative array keyed by column name.
            while ($row = $result_plot->fetch_assoc()):
        ?>
            <tr>
                <!-- Output values safely to the page.
                     htmlspecialchars() ensures database text is displayed as plain content
                     instead of being interpreted as HTML or JavaScript. -->
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['water_rate']) ?></td>
                <td><?= htmlspecialchars($row['longitude']) ?></td>
                <td><?= htmlspecialchars($row['latitude']) ?></td>
            </tr>
        <?php endwhile; ?>
        </table>
    </body>
</html>

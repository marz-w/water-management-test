<?php
    // -----------------------------------------------------------------------------
    // This script connects to the water management database and fetches billing
    // records. Each row is shown in a table so the user can review the recorded
    // billing information for plots and meter readings.
    // -----------------------------------------------------------------------------

    // Database credentials for establishing a MySQL connection.
    // These values are required before any query can be executed.
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "watermanagement";

    // Connect to the database using PHP's MySQLi extension.
    // The constructor creates an object that manages the connection and allows
    // us to run queries against the selected database.
    $conn = new mysqli($host, $username, $password, $database);

    // A failed database connection should halt script execution.
    // This helps avoid generating broken pages when the database is unavailable.
    if (!$conn) {
        die("Connection Failed!");
    }

    // The SQL statement retrieves billing information needed for the report.
    // We select the ID, the date when the record was logged, the related plot,
    // and the current meter reading value from the billing table.
    $sql_billing = "select id, record_date, plot_id, meter_reading from billing";

    // Run the billing query and keep the returned result set in memory.
    // The result is later iterated to print each billing row in the browser.
    $result_billing = $conn->query($sql_billing);
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- This is the page label shown in the browser tab. -->
        <title>Billings</title>
    </head>
    <body style="display:grid;place-items:center">
        <!-- This heading tells the user this page is listing billing data. -->
        <h1>Billing List</h1>

        <?php
            // Check whether the query returned any records.
            // If records exist, they will be displayed in the table below.
            if ($result_billing->num_rows > 0)
        ?>
        <table border="1">
            <tr>
                <!-- Column names are defined to match the selected database fields. -->
                <th>ID</th>
                <th>Record Date</th>
                <th>Plot ID</th>
                <th>Meter Reading</th>
            </tr>

        <?php
            // Loop through each row returned by the query.
            // fetch_assoc() converts one record into an associative array, allowing
            // us to access data by column name such as plot_id or meter_reading.
            while ($row = $result_billing->fetch_assoc()):
        ?>
            <tr>
                <!-- The values are escaped before display to prevent injection and
                     ensure the page renders safe text even when the data contains HTML-like characters. -->
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['record_date']) ?></td>
                <td><?= htmlspecialchars($row['plot_id']) ?></td>
                <td><?= htmlspecialchars($row['meter_reading']) ?></td>
            </tr>
        <?php endwhile; ?>
        </table>
    </body>
</html>

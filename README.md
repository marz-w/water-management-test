# Water Management Test (PHP Learning Project)

A small PHP + MySQL project built while learning server-side programming. It models **efficient water management in a ward**: locations, plots, and the monthly meter readings used for billing. Each page reads from the database and displays the data in an HTML table.

## What I Learned

- Connecting PHP to MySQL with `mysqli`
- Running SQL queries from PHP and looping through results
- Using `fetch_assoc()` to read each row by column name (e.g. `plot_id`, `meter_reading`)
- Mixing PHP and HTML with the alternative syntax (`while: ... endwhile;`)
- Preventing XSS by escaping output with `htmlspecialchars()`
- Running a PHP project with the built-in development server
- Managing tables with phpMyAdmin (XAMPP)

## Project Structure

```
water_management_test/
├── location.php   # Lists locations in the ward
├── plots.php      # Lists plots and their locations
└── billing.php    # Lists monthly meter readings per plot (Billing List)
```

## Database Design

| Table      | Purpose                                      |
|------------|----------------------------------------------|
| `Location` | Areas/zones within the ward                  |
| `Plots`    | Individual plots, each linked to a location  |
| `Billing`  | Monthly meter readings recorded for each plot |
| `Payments` | Payments made against bills                  |

### Billing table columns

| Column          | Description                          |
|-----------------|--------------------------------------|
| `id`            | Unique record ID                     |
| `record_date`   | Date the reading was recorded        |
| `plot_id`       | The plot the reading belongs to      |
| `meter_reading` | Meter reading value (decimal)        |

## Requirements

- PHP 8+
- MySQL / MariaDB (via XAMPP)
- phpMyAdmin (to create the tables)
- A browser

## Setup

1. **Clone the repo**
   ```bash
   git clone https://github.com/marz-w/water-management-test.git
   cd water-management-test
   ```

2. **Start MySQL** from the XAMPP Control Panel.

3. **Create the database and tables**
   Open phpMyAdmin, create a database (e.g. `water_management`), then run your table definitions in the **SQL** tab and insert the sample data.

4. **Set your database credentials**
   In each PHP file, update the connection details to match your setup:
   ```php
   $conn = new mysqli("localhost", "root", "", "water_management");
   ```

5. **Start the PHP server** from the project folder:
   ```bash
   php -S 127.0.0.1:8000
   ```

6. **Open the pages** in your browser:
   - http://127.0.0.1:8000/location.php
   - http://127.0.0.1:8000/plots.php
   - http://127.0.0.1:8000/billing.php

## Expected Output

Opening `billing.php` shows a **Billing List** page with a table of readings, centered on the page:

| ID | Record Date | Plot ID | Meter Reading |
|----|-------------|---------|---------------|
| 1  | 2026-07-01  | 1       | 0.00          |
| 2  | 2026-07-01  | 2       | 0.00          |
| 3  | 2026-07-01  | 3       | 0.00          |
| 4  | 2026-07-01  | 4       | 0.00          |
| 5  | 2026-07-01  | 5       | 0.00          |
| 6  | 2026-07-01  | 6       | 0.00          |
| 7  | 2026-08-01  | 1       | 12.00         |
| 8  | 2026-08-01  | 2       | 8.00          |
| 9  | 2026-08-01  | 3       | 20.00         |
| 10 | 2026-08-01  | 4       | 25.00         |
| ...| ...         | ...     | ...           |
| 24 | 2026-10-01  | 6       | 32.00         |

There are six plots, with one reading per plot on the 1st of each month from July to October 2026 (24 rows).

## How `billing.php` Works

1. Connects to the database.
2. Runs a `SELECT` query on the `Billing` table.
3. Loops through the results with `while ($row = $result_billing->fetch_assoc())`.
4. Prints each row as a `<tr>`, wrapping every value in `htmlspecialchars()` so the page stays safe even if the data contains HTML characters.

## Next Steps

- Calculate monthly water usage (current reading minus previous reading)
- Generate bills from usage
- Record and display payments
- Join `Billing`, `Plots` and `Location` to show names instead of IDs
- Switch to prepared statements for queries that take user input

## Author

**Martha** ([@marz-w](https://github.com/marz-w))

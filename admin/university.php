<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Information</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #F2F2F2;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>
<?php
$tableStyle = isset($_POST['get_api']) ? '' : 'display: none;'; 
?>
<form action="" method="POST">
    <button type="submit" name="get_api" class="btn btn-success">
        Get API's
    </button>
</form>

<!-- Add some space between the button and the table -->
<div style="margin-top: 20px;"></div>

<table id="DataTable" style="<?= $tableStyle ?>">
    <thead>
        <tr>
            <th>University</th>
            <th>Country Code</th>
            <th>Country</th>
            <th>Domain</th>
            <th>Web Page</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST['get_api'])) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://universities.hipolabs.com/search?country=United+States',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'API_KEY: AIzaSyBvoXxD47x6-FrO3UztXKAPwVUlhKne9Qc'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $json_array = json_decode($response, true);

            foreach ($json_array as $university) {
                echo "<tr>";
                echo "<td>" . ($university['name'] ?? '') . "</td>";
                echo "<td>" . ($university['alpha_two_code'] ?? '') . "</td>";
                echo "<td>" . ($university['country'] ?? '') . "</td>";
                echo "<td>" . ($university['domains'][0] ?? '') . "</td>";
                echo "<td><a href='" . ($university['web_pages'][0] ?? '') . "' target='_blank'>" . ($university['web_pages'][0] ?? '') . "</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#DataTable').DataTable({
            "pageLength": 10 // Show 10 entries per page
        });
    });
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University API</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php include("header.php"); ?>
    <?php
    $tableStyle = isset($_POST['get_api']) ? '' : 'display: none;';
    ?>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>University API</h4>
                <form action="" method="POST" class="mb-0">
                    <button type="submit" name="get_api" class="btn btn-primary">
                        <i class="bi bi-cloud-download me-1"></i> Fetch API Data
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="DataTable" class="table table-hover" style="<?= $tableStyle ?>">
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
                                    CURLOPT_URL => 'https://raw.githubusercontent.com/Hipo/university-domains-list/master/world_universities_and_domains.json',
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => '',
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'GET',
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);

                                $json_array = json_decode($response, true);


                                if (is_array($json_array)) {

                                    $json_array = array_filter($json_array, function ($university) {
                                        return $university['country'] === 'United States';
                                    });

                                    foreach ($json_array as $university) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($university['name'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($university['alpha_two_code'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($university['country'] ?? '') . "</td>";
                                        echo "<td>" . htmlspecialchars($university['domains'][0] ?? '') . "</td>";
                                        echo "<td><a href='" . htmlspecialchars($university['web_pages'][0] ?? '') . "' target='_blank'>" . htmlspecialchars($university['web_pages'][0] ?? '') . "</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-danger'>Could not load JSON from GitHub</td></tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                "pageLength": 10
            });
        });
    </script>

</body>

</html>
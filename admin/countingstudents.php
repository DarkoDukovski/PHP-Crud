<?php
// include auth_session.php file on all user panel pages

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $studentCount
$studentCount = 0;

// SQL query to count students
$sql = "SELECT COUNT(id) AS student_count FROM students";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $studentCount = $row['student_count'];
}

$conn->close();
?>


<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$newsCount = 0;

// SQL query to count news by title
$sql = "SELECT COUNT(DISTINCT title) AS news_count FROM news";

$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $newsCount = $row['news_count'];
}

$conn->close();
?>




<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$countactivenews = 0;

// SQL query to count Active news by title
$sql = "SELECT COUNT(status) AS activeCount FROM news WHERE status = '1';
";

$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $countactivenews = $row['activeCount'];
}

$conn->close();
?>



<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$countinactivenews = 0;

// SQL query to count Inactive news by title
$sql = "SELECT COUNT(status) AS inactiveCount FROM news WHERE status = '0';
";

$result = $conn->query($sql);

if ($result === false) {
    echo "Error executing the query: " . $conn->error;
} else {
    $row = $result->fetch_assoc();
    $countinactivenews = $row['inactiveCount'];
}

$conn->close();
?>

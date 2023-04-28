<?php
header("Content-Type: application/json");
if (isset($_POST['service_id'])) {

    include_once "connect.php";
    $conn = new connect();
    $sql = '';
    $service_id = $_POST['service_id'];
    if ($service_id == 'all') {
        $sql = "SELECT * FROM portfolio;";
    } else {
        $sql = "SELECT * FROM portfolio WHERE service_id = '$service_id' ;";
    }

    try {
        $stmt = $conn->getConnect()->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Problem Somewhere" . $e->getMessage();
    }

    $images = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $base64_encode = base64_encode($row['image']);
        $title = $row['title'];
        $image =
            "
            <div class='image-section'>
                <img src='data:image/jpg;base64,$base64_encode' alt='before and after' />
                <a href='#'>
                    <div class='description-image'>
                        <span>$title</span>
                    </div>
                </a>
          </div>
        ";
        array_push($images, $image);
    }
    echo json_encode(['images' => $images]);
}
?>
<?php
header("Content-Type: application/json");
if (isset($_POST['service_id']) && $_POST['service_id'] != '') {

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
        $id = $row['id'];
        $title = $row['title'];
        $src = 'data:image/jpg;base64,'.base64_encode($row['image']);
        $service_id = $row['service_id'];
        $description = $row['description'];

        $image =['id'=>$id,'title'=>$title,'src'=>$src,'service_id'=>$service_id,'description'=>$description];
        array_push($images, $image);
    }
    echo json_encode(['images' => $images]);
}
else{
    echo json_encode(['images'=>['<h1 style="margin:auto;margin-top:3rem;">Il n\'y a pas d\'images ! </h1>']]);
}

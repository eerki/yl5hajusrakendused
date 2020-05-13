<?php
// json only

require 'connect.php';

$k=$_GET['k'];

if($k == null) {
    $query = "SELECT * FROM my_favorite_subject";
} else {
    $query = "SELECT * FROM my_favorite_subject LIMIT $k";
}

$datas =
    [
        'info' => [
            'name' => 'Eerik Põld',
            'description' => 'my favorite subject'
        ],
    ];

if ($result = $mysqli->query($query)) {
    while ($data = $result->fetch_array()) {
        $datas['data'][] =
            [
                'title' => $data['title'],
                'image' => $data['image'],
                'description' => $data['description'],
                'topic1'=> $data['episodes'],
                'topic2' => $data['air']
        ];
    }
    $result->close();
}

echo json_encode($datas);
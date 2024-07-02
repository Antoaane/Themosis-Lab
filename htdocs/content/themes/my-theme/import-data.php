<?php
// FILEPATH: /C:/Users/PC Julien/Documents/DEV/Themosis-Lab/htdocs/content/themes/my-theme/import-data.php

$csvFile = './membre-data.csv';
$data = [];

if (($handle = fopen($csvFile, 'r')) !== false) {
    while (($row = fgetcsv($handle, 1000, ',')) !== false) {
        $data[] = $row;
    }
    fclose($handle);
}

var_dump($data);


foreach ($data as $row) {
    $post = [
        'post_title' => $row[0],
        'post_type' => 'membre',
        'post_status' => 'publish',
    ];

    $postId = wp_insert_post($post);

    if ($postId) {
        update_post_meta($postId, 'membre_nom', $row[1]);
        update_post_meta($postId, 'membre_prenom', $row[2]);
        update_post_meta($postId, 'membre_poste', $row[3]);
        update_post_meta($postId, 'membre_photo', $row[4]);
    }
}


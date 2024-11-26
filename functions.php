<?php
// functions.php

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

function addTask($name, $description) {
    $id = count($_SESSION['tasks']); // Simple ID generation
    $_SESSION['tasks'][] = [
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'status' => 'not completed',
        'date' => date('d/m/Y')
    ];
}

function markAsCompleted($id) {
    if (isset($_SESSION['tasks'][$id])) {
        $_SESSION['tasks'][$id]['status'] = 'completed';
    }
}

function deleteTask($id) {
    if (isset($_SESSION['tasks'][$id])) {
        unset($_SESSION['tasks'][$id]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
    }
}
?>
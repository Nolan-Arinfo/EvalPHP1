<?php
// Initialisation des variables
$tasks = [];  // Tableau pour stocker les tâches

// Ajouter une tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['task_name']) && !empty($_POST['task_name'])) {
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];

        // Créer une tâche avec un identifiant unique et un statut par défaut
        $task = [
            'id' => uniqid(),  // ID unique généré
            'name' => $task_name,
            'description' => $task_description,
            'status' => 'Non terminée'
        ];

        // Ajouter la tâche dans le tableau $tasks
        $tasks[] = $task;
    }
}

// Marquer une tâche comme terminée
if (isset($_GET['mark_done'])) {
    $task_id = $_GET['mark_done'];
    foreach ($tasks as $key => $task) {
        if ($task['id'] == $task_id) {
            $tasks[$key]['status'] = 'Terminée'; // Mettre à jour le statut de la tâche
        }
    }
}

// Supprimer une tâche
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    foreach ($tasks as $key => $task) {
        if ($task['id'] == $task_id) {
            unset($tasks[$key]); // Supprimer la tâche du tableau
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Simple styles pour les tâches terminées */
        .completed {
            background-color: #d3ffd3;
        }
    </style>
</head>
<body>
    <h1>Gestion de tâches - To-Do List</h1>

    <!-- Formulaire pour ajouter une tâche -->
    <form method="POST" action="">
        <label for="task_name">Nom de la tâche :</label>
        <input type="text" id="task_name" name="task_name" required>
        <br>
        <label for="task_description">Description :</label>
        <textarea id="task_description" name="task_description"></textarea>
        <br>
        <button type="submit">Ajouter la tâche</button>
    </form>

    <h2>Liste des tâches</h2>

    <!-- Tableau pour afficher les tâches -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les tâches
            foreach ($tasks as $task) {
                echo '<tr' . ($task['status'] == 'Terminée' ? ' class="completed"' : '') . '>';
                echo '<td>' . $task['id'] . '</td>';
                echo '<td>' . $task['name'] . '</td>';
                echo '<td>' . $task['description'] . '</td>';
                echo '<td>' . $task['status'] . '</td>';
                echo '<td>';
                // Lien pour marquer comme terminée
                if ($task['status'] != 'Terminée') {
                    echo '<a href="?mark_done=' . $task['id'] . '">Marquer comme terminée</a> | ';
                }
                // Lien pour supprimer la tâche
                echo '<a href="?delete=' . $task['id'] . '">Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>

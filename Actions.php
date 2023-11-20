<?php 
@include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit();
}

if (isset($_POST['apply_plan'])) {
    $user_id = $_SESSION['user_id'];
    $plan_id = $_POST['plan_id'];

    // Check if the plan_id exists in the plan_list table
    $stmt = $conn->prepare("SELECT COUNT(*) FROM plan_list WHERE plan_id = ?");
    $stmt->execute([$plan_id]);

    if ($stmt->fetchColumn() > 0) {
        // Insert a new application record
        $stmt = $conn->prepare("INSERT INTO applications (user_id, plan_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $plan_id]);

        if ($stmt->rowCount() > 0) {
            // Application successful, redirect to the user's profile or a confirmation page
            header('Location: index.php');
            exit();
        } else {
            echo '<script>alert("Application failed."); location.replace("./");</script>';
            exit();
        }
    } else {
        echo '<script>alert("Invalid plan ID."); location.replace("./");</script>';
        exit();
    }
}

?>
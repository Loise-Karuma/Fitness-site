<?php
include 'config.php';
include 'includes/header.php';

// Handle Confirm Application Action
if (isset($_POST['confirm_application'])) {
    $applicationId = $_POST['application_id'];
    $status = 1; // Change this to the status code for 'Confirmed'

    $stmt = $conn->prepare("UPDATE applications SET status = :status WHERE id = :applicationId");
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
    $stmt->execute();
    // Handle success or error here, e.g., show a message
}

// Handle Reject Application Action
if (isset($_POST['reject_application'])) {
    $applicationId = $_POST['application_id'];
    $status = 2; // Change this to the status code for 'Rejected'

    $stmt = $conn->prepare("UPDATE applications SET status = :status WHERE id = :applicationId");
    $stmt->bindParam(':status', $status, PDO::PARAM_INT);
    $stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
    $stmt->execute();
    // Handle success or error here, e.g., show a message
}

// Handle Delete Application Action
if (isset($_POST['delete_application'])) {
    $applicationId = $_POST['application_id'];

    $stmt = $conn->prepare("DELETE FROM applications WHERE id = :applicationId");
    $stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
    $stmt->execute();
    // Handle success or error here, e.g., show a message
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Application List</h3>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-bordered">
            <!-- Your table headers go here -->
            <tbody>
                <?php
                $show_applications = $conn->prepare("
                    SELECT
                        a.id AS application_id,
                        u.name AS user_name,
                        p.title AS plan_title,
                        a.status AS application_status,
                        a.application_date
                    FROM
                        applications a
                    JOIN
                        users u ON a.id = u.id
                    JOIN
                        plan_list p ON a.plan_id = p.plan_id
                    ORDER BY a.application_date DESC
                ");
                $show_applications->execute();
                
                if ($show_applications->rowCount() > 0) {
                    while ($row = $show_applications->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $row['user_name'] . '</td>';
                        echo '<td>' . $row['plan_title'] . '</td>';
                        echo '<td>' . $row['application_status'] . '</td>';
                        echo '<td>' . $row['application_date'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<p class="empty">No applications found!</p>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

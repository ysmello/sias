<?php
include '../../config/database.php';

if (isset($_GET['prof_id'])) {
    $prof_id = $_GET['prof_id'];
    $stmt = $conn->prepare("SELECT * FROM profissional_disponibilidade WHERE prof_id = ?");
    $stmt->execute([$prof_id]);
    $horarios = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['horarios' => $horarios]);
}
?>
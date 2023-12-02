<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/certi.css">
    <title>EduGameHub</title>
</head>
<?php
session_start();
include_once "../sqlFetchingQuery.php";
$tableController = new tableController();
$currentUserId = $_SESSION['user_id'];
if ($certificates = $tableController->fetchCurrentStudentsCert($currentUserId)) {
    $certificateCount = count($certificates);
    $fullStudentName = $certificates[0]->full_name;
} else {
    $certificateCount = 0;
}
?>

<body>
    <header>
        <a href="home.php"><img src="Gamelogo.png" alt="Your Image" width="400"></a>
        <div class="logoutLogo">
            <a href="../logout.php"><img src="logout.png" class="logoutImage"></a>
        </div>
    </header>

    <div class="back-button">
        <a href="index.php"><img src="back.png" alt="Back" width="60"></a>
    </div>
    <div class="certificatesArrangement">
        <?php
        if ($certificateCount > 0) :
            for ($x = 0; $x <= $certificateCount - 1; $x++) :
                if ($certificates[$x]->cert_subject == "English") :
        ?>
                    <div id="english">
                        <canvas id="englishCanvas" height="350px" width="500px"></canvas>
                    </div>
                <?php
                endif;
                ?>
                <?php if ($certificates[$x]->cert_subject == "Math") : ?>
                    <div id="math">
                        <canvas id="mathCanvas" height="350px" width="500px"></canvas>
                    </div>
                <?php endif; ?>
                <?php if ($certificates[$x]->cert_subject == "Science") : ?>
                    <div id="science">
                        <canvas id="scienceCanvas" height="350px" width="500px"></canvas>
                    </div>
                <?php endif; ?>
                <?php if ($certificates[$x]->cert_subject == "Overall") : ?>
                    <div id="overall">
                        <canvas id="overallCanvas" height="350px" width="500px"></canvas>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
</body>

</html>
<script>
    var fullStudentName = <?php echo json_encode($fullStudentName); ?>
</script>
<script src="certificateReceiver.js"></script>
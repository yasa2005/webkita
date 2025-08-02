<?php
if (isset($_POST['filename'])) {
    $uploadDir = "uploads/";
    $file = $uploadDir . basename($_POST['filename']);
    if (file_exists($file)) {
        unlink($file);
    }
}
header("Location: ina.php");
exit;
?>

<?php
if (isset($_FILES['image'])) {
    $uploadDir = "uploads/";

    // Buat folder jika belum ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = basename($_FILES['image']['name']);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Tipe file tidak diizinkan. Hanya JPG, JPEG, PNG, GIF.";
        exit;
    }

    // Buat nama unik agar tidak tertimpa file lain
    $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);
    $targetFile = $uploadDir . $newFileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        header("Location: ina.php");
        exit;
    } else {
        echo "Gagal mengupload file.";
    }
} else {
    echo "Tidak ada file yang diupload.";
}
?>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

if (file_exists($target_file)) {
    echo "<script>alert('Maaf, berkas sudah ada.'); window.location.href='index.html';</script>";
    $uploadOk = 0;
    exit;
}

if ($_FILES["fileToUpload"]["size"] > 2000000) {
    echo "<script>alert('Maaf, berkas terlalu besar.'); window.location.href='index.html';</script>";
    $uploadOk = 0;
    exit;
}

if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        header("Location: index.html");
        exit;
    } else {
        echo "<script>alert('Gagal mengunggah berkas.'); window.location.href='index.html';</script>";
    }
}
?>
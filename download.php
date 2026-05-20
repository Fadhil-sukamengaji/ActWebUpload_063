<?php
$target_dir = "uploads/";

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $file_path = $target_dir . $file;

    if (file_exists($file_path)) {
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        readfile($file_path);
        exit;
    } else {
        echo "<script>alert('Maaf, berkas tidak ditemukan.'); window.location.href='index.html';</script>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
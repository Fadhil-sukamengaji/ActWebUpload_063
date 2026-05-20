<?php
$target_dir = "uploads/";

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['file'])) {
    $file_to_delete = $target_dir . basename($_GET['file']);
    if (file_exists($file_to_delete)) {
        unlink($file_to_delete);

        header("Location: daftar.php"); 
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-600 text-sm overflow-y-auto">
    
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-gray-200 text-gray-400 text-xs font-medium uppercase">
                <th class="pb-3 text-center w-24">Pratinjau</th>
                <th class="pb-3 pl-4">Nama Berkas</th>
                <th class="pb-3">Tipe</th>
                <th class="pb-3">Ukuran</th>
                <th class="pb-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php
            if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
            
            $files = array_diff(scandir($target_dir), array('.', '..'));
            
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $file_path = $target_dir . $file;
                    $ext = strtoupper(pathinfo($file_path, PATHINFO_EXTENSION));
                    $size = round(filesize($file_path) / 1024, 2) . ' KB';
                    
                    echo "<tr>";

                    echo "<td class='py-3 flex justify-center'>";
                    if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo "<img src='$file_path' class='h-10 w-10 object-cover rounded-xl shadow-sm'>";
                    } else {
                        echo "<div class='h-10 w-10 bg-gray-100 rounded-xl flex items-center justify-center text-[10px] font-bold text-gray-400'>FILE</div>";
                    }
                    echo "</td>";
                    
                    echo "<td class='py-3 pl-4 font-medium text-gray-700'>" . htmlspecialchars($file) . "</td>";
                    echo "<td class='py-3'><span class='bg-blue-100 text-blue-600 px-2 py-0.5 rounded text-xs font-semibold'>$ext</span></td>";
                    echo "<td class='py-3'>$size</td>";
                    
                    echo "<td class='py-3 text-center'>";
                    echo "<div class='flex justify-center gap-2'>";

                    echo "<a href='download.php?file=" . urlencode($file) . "' class='border border-green-500 text-green-500 hover:bg-green-50 px-3 py-1 rounded-xl text-xs transition-colors'>Unduh</a>";
                    echo "<a href='daftar.php?action=delete&file=" . urlencode($file) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus berkas ini?\")' class='border border-red-300 text-red-500 hover:bg-red-50 px-3 py-1 rounded-xl text-xs transition-colors'>Hapus</a>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='py-8 text-center text-gray-400 italic'>Belum ada berkas yang diunggah.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
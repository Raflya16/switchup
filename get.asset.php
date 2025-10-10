    <?php
    
    // Keamanan dasar: Hanya izinkan file dari dalam folder 'build'
    if (!isset($_GET['file']) || strpos($_GET['file'], '..') !== false || substr($_GET['file'], 0, 6) !== 'build/') {
        http_response_code(404);
        die('File not found or access denied.');
    }
    
    // Dapatkan path file yang diminta dari URL
    $requestedFile = $_GET['file'];
    
    // Bangun path absolut di server
    $basePath = __DIR__ . '/';
    $fullPath = $basePath . $requestedFile;
    
    // Periksa apakah file benar-benar ada
    if (!file_exists($fullPath)) {
        http_response_code(404);
        die('Error: Server cannot find file at path: ' . htmlspecialchars($fullPath));
    }
    
    // Tentukan tipe konten berdasarkan ekstensi file
    $extension = pathinfo($fullPath, PATHINFO_EXTENSION);
    $mimeType = 'text/plain'; // Default
    if ($extension === 'css') {
        $mimeType = 'text/css';
    } elseif ($extension === 'js') {
        $mimeType = 'application/javascript';
    }
    
    // Kirim header tipe konten yang benar
    header('Content-Type: ' . $mimeType);
    
    // Baca dan tampilkan isi file
    readfile($fullPath);
    
    ?>
    

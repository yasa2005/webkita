<?php
// Pastikan folder uploads ada
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Galeri Foto Publik</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-pink-100 min-h-screen text-gray-800">
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-4xl font-bold text-center text-pink-600 mb-8">Galeri Foto Publik</h1>

    <!-- Form Upload -->
    <form action="upload.php" method="post" enctype="multipart/form-data" class="mb-8 bg-white p-4 rounded-xl shadow">
      <label class="block mb-2 font-semibold">Pilih gambar untuk diupload:</label>
      <input type="file" name="image" class="mb-4" required>
      <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full shadow">Upload</button>
    </form>

    <!-- Galeri -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php
      $files = array_diff(scandir($uploadDir), ['.', '..']);
      foreach ($files as $file):
        $filePath = $uploadDir . $file;
      ?>
        <div class="bg-white rounded-xl overflow-hidden shadow relative">
          <img src="<?= htmlspecialchars($filePath) ?>" alt="<?= htmlspecialchars($file) ?>" class="w-full h-64 object-cover" />
          <form action="delete.php" method="post" class="absolute top-2 right-2">
            <input type="hidden" name="filename" value="<?= htmlspecialchars($file) ?>" />
            <button type="submit" class="bg-red-500 text-white px-2 py-1 text-xs rounded hover:bg-red-600" onclick="return confirm('Yakin mau hapus gambar ini?')">🗑</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="text-center mt-8 text-sm text-gray-500">💌 Semua gambar bisa dilihat dan diupload oleh semua orang.</p>
  </div>
</body>
</html>

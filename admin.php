
<?php
    if (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $file_name = $_FILES['testfile']['name'];
    $tmp_file = $_FILES['testfile']['tmp_name'];
    $uploads_dir = 'tests/';
    $path_info = pathinfo($uploads_dir . $file_name);
    if ($path_info['extension'] === 'json') {
        move_uploaded_file($tmp_file, $uploads_dir . $file_name);
        header('Location: ' . 'list.php');
    }else
        {
echo 'Извините, нужен файл с расширением JSON';
}
}
?>

<form method="post" action="list.php" enctype="multipart/form-data">
	Ваша фамилия <input type="text" name="surname">
	Файл с тестом <input type="file" name="file">
	<input type="submit" name="отправить">
</form>
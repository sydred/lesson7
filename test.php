<?php

$file_list = glob('tests/*.json');
$number = $_GET['number'];
$test = file_get_contents($file_list[$number]);
$test = json_decode($test, true);
if (isset($_POST['result'])) {
    function checkTest($testFile)
    {
    foreach ($testFile as $key => $item) {
    if (!isset($_POST['answer' . $key])) {
        echo 'Должны быть решены все задания!';
        exit;
    }
    }
        $i = 0;
        $questions = 0;
        foreach ($testFile as $key => $item) {
            $questions++;
            if ($item['correct_answer'] === $_POST['answer' . $key]) {
                $i++;
                $infoStyle = 'correct';
            } else {
                $infoStyle = 'incorrect';
            }
            echo "<div class=\"$infoStyle\">";
            echo 'Вопрос: ' . $item['question'] . '<br>';
            echo 'Ваш ответ: ' . $item['answers'][$_POST['answer' . $key]] . '<br>';
            echo 'Правильный ответ: ' . $item['answers'][$item['correct_answer']] . '<br>';
            echo '</div>';
            echo '<hr>';

        }
            if (!empty($_POST['result'])) {
                $name = $_POST['result'];
                $im = imagecreatetruecolor(565, 800);

                $backColor = imagecolorallocate($im, 255, 224, 221);
                $textColor = imagecolorallocate($im, 0, 0, 0);
                $fontFile = 'font.ttf';

                $imBox = imagecreatefrompng('123.png');

                imagefill($im, 0, 0, $backColor);
                imagecopy($im, $imBox, 0, 0, 0, 0, 565, 800);
                imagettftext($im, 20, 0, 170, 392, $textColor, $fontFile, $name);
                imagettftext($im, 20, 0, 170, 420, $textColor, $fontFile, 'Оценка: отлично');
                imagettftext($im, 15, 0, 385, 745, $textColor, $fontFile, date("d.m.y"));
                imagejpeg($im, 'certificate.jpg');
                imagedestroy($im);

                echo '<p style="font-weight: bold;">Итого правильных ответов: ' . $i . ' из ' . $questions . '</p>';
        }
    }


}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>test</title>
</head>
<body>
<a href="<?php echo isset($_POST['result']) ? $_SERVER['HTTP_REFERER'] : 'list.php' ?>"><div>< Назад</div></a><br>

<?php if (isset($_GET['number']) && !isset($_POST['result'])): ?>
    <form method="POST">
        <h1><?php echo basename($file_list[$number]); ?></h1>
        <?php foreach($test as $key => $item):  ?>
            <fieldset>
                <legend><?php echo $item['question'] ?></legend>
                <div class="on-hidden-radio"></div>

                <label><input type="radio" name="answer<?php echo $key ?>" value="0"><?php echo $item['answers'][0] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="1"><?php echo $item['answers'][1] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="2"><?php echo $item['answers'][2] ?></label><br>
                <label><input type="radio" name="answer<?php echo $key ?>" value="3"><?php echo $item['answers'][3] ?></label>
            </fieldset>
        <?php endforeach;?>
        <input type="submit" name="result" value="Проверить">
    </form>
<?php endif;?>
<?php if(!empty($_POST['result'])): ?>
    <form method="post">
        <input type="text" name="name_form" placeholder="Введите ваше имя">
        <button>Отправить</button>
    </form>
<?php endif;?>

<?php if (!empty($_POST['result'])): ?>
    <img src="123.png" alt="Ваш сертификат">
<?php endif;?>
<div class="check_test">
    <?php if (isset($_POST['result'])) echo checkTest($test); ?>
</div>

</body>

</html>
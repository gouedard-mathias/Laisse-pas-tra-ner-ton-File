<?php
use FilesystemIterator;

$it = new FilesystemIterator('uploads');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="imageUpload">Upload an profile image</label>
        <input type="file" name="files[]" multiple="multiple" id="imageUpload"/>
        <input type="submit" value="Upload">
    </form>
    <?php foreach ($_GET as $error) : ?>
        <p><?= $error ?></p>
    <?php endforeach; ?>
    <?php foreach ($it as $fileinfo) : ?>
        <figure>
            <img src="<?= $fileinfo->getPathname() ?>"
                 alt="<?= $fileinfo->getFilename() ?>">
            <figcaption><?= $fileinfo->getFilename() ?></figcaption>
            <form action="delete.php" method="post">
                <input type="hidden" id="name" name="name" value="<?= $fileinfo->getPathname() ?>">
                <button>Delete</button>
            </form>
        </figure>
    <?php endforeach; ?>
</body>
</html>

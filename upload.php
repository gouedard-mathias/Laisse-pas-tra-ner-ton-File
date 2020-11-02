<?php
if (!empty($_FILES['files']['name'][0])) {
    $files = $_FILES['files'];
    $uploaded = [];
    $failed = [];
    $allowed = ['jpg','png','gif'];

    foreach ($files['name'] as $position => $file_name) {
        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];

        $file_ext = pathinfo($files['name'][$position], PATHINFO_EXTENSION);
        if (in_array($file_ext, $allowed)) {
            if ($file_size <= 1000000) {
                $file_name_new = uniqid('',true) . '.' . $file_ext;
                $file_destination = 'uploads/' . $file_name_new;

                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $uploaded[$file_name] = $file_destination;
                } else {
                    $failed[$position] = "[{$file_name}] failed to upload.";
                }
            } else {
                $failed[$position] = "[{$file_name}] is too large.";
            }
        } else {
            $failed[$position] = "[{$file_name}] file extension '{$file_ext}' is not allowed.";
        }
    }

    $uploadedQueryString = http_build_query($uploaded);
    $failedQueryString = http_build_query($failed);

    if (!empty($uploaded)) {
        if (count($failed) === 0) {
            header('location: index.php');
        }
    }  else {
        header('location: index.php?' . $failedQueryString);
    }
} else {
    header('location: index.php');
}

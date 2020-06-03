<?php
use App\Core\FormHelper;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
</head>
<body>
    <div class="container">
        <div class="center txt-organe">
            404 | Not Found
            <?=FormHelper::generateInputForError($data, $url_back)?>
        </div>
    </div>
</body>
</html>
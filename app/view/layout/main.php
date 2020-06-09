<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo relativePath('/public/css/style.css')?>">
    <?php echo $this->content('head');?>
    <title><?php echo $this->_siteTitle?></title>
</head>
<body>

    <!-- body -->
    <div>
        <?php echo $this->content('body');?>
    </div>
    <!-- End body -->

    <!-- javaScript -->
    <?php echo $this->content('script');?>
</body>
</html>
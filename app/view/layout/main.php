<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=PROJECT_PATH?>public/css/style.css">
    <?=$this->content('head');?>
    <title><?=$this->_siteTitle?></title>
</head>
<body>
    <div><?=$this->content('body');?></div>
    <?=$this->content('script');?>
</body>
</html>
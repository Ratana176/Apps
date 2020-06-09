<?php $this->setSiteTitle($message_title);?>

<?php $this->start('head');?>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" href="<?=PROJECT_PATH?>public/css/style.css">
<?php $this->end();?>

<?php $this->start('body');?>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md text-danger">
            <?=$message?>
        </div>
        <?=$input_contents?>
    </div>
</div>
<?php $this->end();?>
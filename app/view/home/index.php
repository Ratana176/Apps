<?php $this->setSiteTitle('Home'); ?>

<?php $this->start('head')?>

<?php $this->end()?>


<?php $this->start('body')?>
    <form action="/" method="POST">

        <input type="email" name="email" id="email">
        <input type="password" name="password" id="password">
        <input type="submit" value="Add">
    </form>
<?php $this->end()?>

<?php $this->start('script')?>

<?php $this->end()?>

<?php $this->start('body');?>
    <h1><?php echo lang('messages.create_company');?></h1>
    <br>
    <form action="<?php echo relativePath('/company/create')?>" method="POST">
        <div class="input">
            Name: <input type="text" name="name" value="<?php echo $company->name;?>">
        </div>

        <div class="input">
            License number: <input type="text" name="license_no" value="<?php echo $company->license_no;?>">
        </div>

        <div class="input">
            Address: <input type="text" name="address" value="<?php echo $company->address;?>">
        </div>

        <div class="input">
            <input class="btn-sm right" type="submit" value="<?php echo lang('messages.create')?>">
            <a class="btn" href="<?php echo relativePath('/company')?>"><?php echo lang('messages.cancel')?></a>
        </div>

    </form>
<?php $this->end();?>
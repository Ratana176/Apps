
<?php $this->start('body');?>
    <h1 class="input"><?php echo lang('messages.edit_employee');?></h1>
    <form action="<?php echo relativePath('/employee/'.$employee->id.'/edit')?>" method="POST">
        <?php method('put');?>
        <input type="hidden" name="company_id" value="<?php echo $employee->company_id;?>">
        <div class="input">
            <?php echo lang('messages.name')?>: <input type="text" name="name" value="<?php echo $employee->name;?>">
        </div>

        <div class="input">
            <?php echo lang('messages.surname')?>: <input type="text" name="surname" value="<?php echo $employee->surname;?>">
        </div>

        <div class="input">
            <?php echo lang('messages.phone')?>: <input type="text" name="telephone" value="<?php echo $employee->telephone;?>">
        </div>

        <div class="input">
            <?php echo lang('messages.salary')?>: <input type="text" name="salary" value="<?php echo $employee->salary;?>">
        </div>

        <div class="input">
            <input class="btn-sm right" type="submit" value="<?php echo lang('messages.save')?>">
            <a class="btn" href="<?php echo relativePath('/company/'. $employee->company_id .'/edit')?>"><?php echo lang('messages.back')?></a>
        </div>

    </form>
<?php $this->end();?>
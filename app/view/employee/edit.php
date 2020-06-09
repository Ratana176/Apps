
<?php $this->start('body');?>
    <p class="input"><?php echo lang('messages.create_employee');?></p>
    <form action="<?php echo relativePath('/employee/'.$employee->id.'/edit')?>" method="POST">
        <?php method('put');?>
        <input type="hidden" name="company_id" value="<?php echo $employee->company_id;?>">
        <div class="input">
            Name: <input type="text" name="name" value="<?php echo $employee->name;?>">
        </div>

        <div class="input">
            Surname: <input type="text" name="surname" value="<?php echo $employee->surname;?>">
        </div>

        <div class="input">
            Telephone: <input type="text" name="telephone" value="<?php echo $employee->telephone;?>">
        </div>

        <div class="input">
            Salary: <input type="text" name="salary" value="<?php echo $employee->salary;?>">
        </div>

        <div class="input">
            <input class="btn-sm right" type="submit" value="<?php echo lang('messages.create')?>">
            <a class="btn" href="<?php echo relativePath('/company/'. $employee->company_id .'/edit')?>"><?php echo lang('messages.cancel')?></a>
        </div>

    </form>
<?php $this->end();?>
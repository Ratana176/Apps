
<?php $this->start('body');?>
    <h1><?php echo lang('messages.create_employee');?></h1>
    <br>
    <form action="<?php echo relativePath('/employee/create')?>" method="POST">
        <div class="input">
            Company Name:
            <select name="company_id" id="company_id">
                <?php foreach($companies as $company):?>
                    <option value="<?php echo $company->id;?>"><?php echo $company->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="input">
            Name: <input type="text" name="name" value="<?php echo $employee->name;?>">
        </div>

        <div class="input">
            Surname: <input type="text" name="license_no" value="<?php echo $employee->surname;?>">
        </div>

        <div class="input">
            Telephone: <input type="text" name="license_no" value="<?php echo $employee->telephone;?>">
        </div>

        <div class="input">
            Salary: <input type="text" name="license_no" value="<?php echo $employee->salary;?>">
        </div>

        <div class="input">
            <input class="btn-sm right" type="submit" value="<?php echo lang('messages.create')?>">
            <a class="btn" href="<?php echo relativePath('/employee')?>"><?php echo lang('messages.cancel')?></a>
        </div>

    </form>
<?php $this->end();?>
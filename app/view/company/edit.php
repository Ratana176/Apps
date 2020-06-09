
<?php $this->start('body');?>
    <p class="input bold">Edit Company</p>
    <form action="<?php echo relativePath('/company/'. $company->id)?>" method="POST">
        <?php method('put');?>

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
            <input class="btn-sm right" type="submit" value="<?php echo lang('messages.edit')?>">
            <a class="btn" href="<?php echo relativePath('/employee/create/?company_id='.$company->id)?>"><?php echo lang('messages.create_employee')?></a>
            <a class="btn" href="<?php echo relativePath('/company')?>"><?php echo lang('messages.cancel')?></a>
        </div>
    </form>
    <p class="input bold">List of employees:</p>
    <?php if (!count($employees)):?>
        <p class="input bold">no employees.</p>
    <?php else: ?>   
        <table>
            <tr>
                <th>N&#176;</th>
                <th>Surname</th>
                <th>Name</th>
                <th>Telephone</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
            <?php foreach($employees as $key => $employee): ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $employee->surname;?></td>
                    <td><?php echo $employee->name;?></td>
                    <td><?php echo $employee->telephone;?></td>
                    <td><?php echo $employee->salary;?></td>
                    <td>
                        <a href="<?php echo relativePath('/employee/'. $employee->id .'/edit');?>"><?php echo lang('messages.edit');?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?> 

<?php $this->end();?>
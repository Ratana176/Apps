
<?php $this->start('body'); ?>
    <h1><?php echo lang('messages.all_company');?></h1>
    <br>
    <table>
        <tr>
            <th>N&#176;</th>
            <th>Surname</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Telephone</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
        <?php foreach($employee_list as $key => $employee): ?>
            <tr>
                <td><?php echo $key+1;?></td>
                <td><?php echo $employee->surname;?></td>
                <td><?php echo $employee->name;?></td>
                <td><?php echo $employee->company_name;?></td>
                <td><?php echo $employee->telephone;?></td>
                <td><?php echo $employee->salary;?></td>
                <td>
                    <a href="<?php echo relativePath('/employee/'. $employee->id .'/edit');?>"><?php echo lang('messages.edit');?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <br>
    <div class="input">
        <a class="btn" href="<?php echo relativePath('/company');?>"><?php echo lang('messages.all_companies');?></a>
        <a class="btn" href="<?php echo relativePath('/employee/create');?>"><?php echo lang('messages.create_employee');?></a>
    </div>
<?php $this->end(); ?>
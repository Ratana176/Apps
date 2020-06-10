
<?php $this->start('body'); ?>
    <h1><?php echo lang('messages.all_companies');?></h1>
    <br>
    <table>
        <tr>
            <th>N&#176;</th>
            <th><?php echo lang('messages.name')?></th>
            <th><?php echo lang('messages.address')?></th>
            <th><?php echo lang('messages.license_no')?></th>
            <th>Action</th>
        </tr>
        <?php foreach($employee_list as $key => $employee): ?>
            <tr>
                <td><?php echo $key+1;?></td>
                <td><?php echo $employee->name;?></td>
                <td><?php echo $employee->address;?></td>
                <td><?php echo $employee->license_no;?></td>
                <td>
                    <a href="<?php echo relativePath('/company/'. $employee->id .'/edit');?>"><?php echo lang('messages.edit');?></a>
                    <a href="<?php echo relativePath('/company/'. $employee->id .'/delete');?>"><?php echo lang('messages.delete')?></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <br>
    <div class="input">
        <a class="btn" href="<?php echo relativePath('/company/create');?>"><?php echo lang('messages.create_company');?></a>
    </div>
<?php $this->end(); ?>
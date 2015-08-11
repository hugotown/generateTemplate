<div class="workstations form">
<?php echo $this->Form->create('Workstation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Workstation'); ?></legend>
	<?php
		echo $this->Form->input('createdAt');
		echo $this->Form->input('updatedAt');
		echo $this->Form->input('createdBy');
		echo $this->Form->input('updatedBy');
		echo $this->Form->input('name');
		echo $this->Form->input('lov_workstation_role');
		echo $this->Form->input('employeeNumber');
		echo $this->Form->input('workarea_id');
		echo $this->Form->input('status');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('building_id');
		echo $this->Form->input('description');
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Workstation.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Workstation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('controller' => 'workstations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>

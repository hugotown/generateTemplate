<div class="workareas form">
<?php echo $this->Form->create('Workarea'); ?>
	<fieldset>
		<legend><?php echo __('Add Workarea'); ?></legend>
	<?php
		echo $this->Form->input('createdBy');
		echo $this->Form->input('updatedBy');
		echo $this->Form->input('createdAt');
		echo $this->Form->input('updatedAt');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Workareas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('controller' => 'workstations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="rolestates form">
<?php echo $this->Form->create('Rolestate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rolestate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('createdAt');
		echo $this->Form->input('updatedAt');
		echo $this->Form->input('createdBy');
		echo $this->Form->input('updatedBy');
		echo $this->Form->input('role_id');
		echo $this->Form->input('statename');
		echo $this->Form->input('accessit');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rolestate.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Rolestate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rolestates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>

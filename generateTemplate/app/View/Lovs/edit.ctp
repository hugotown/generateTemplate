<div class="lovs form">
<?php echo $this->Form->create('Lov'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lov'); ?></legend>
	<?php
		echo $this->Form->input('createdAt');
		echo $this->Form->input('updatedAt');
		echo $this->Form->input('createdBy');
		echo $this->Form->input('updatedBy');
		echo $this->Form->input('orderShow');
		echo $this->Form->input('lovType');
		echo $this->Form->input('name_');
		echo $this->Form->input('name_es_MX');
		echo $this->Form->input('name_en_US');
		echo $this->Form->input('status');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lov.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Lov.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Lovs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lovs'), array('controller' => 'lovs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Lov'), array('controller' => 'lovs', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="rolestates view">
<h2><?php echo __('Rolestate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedAt'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['createdAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedAt'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['updatedAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedBy'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['createdBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedBy'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['updatedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rolestate['Role']['name'], array('controller' => 'roles', 'action' => 'view', $rolestate['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Statename'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['statename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accessit'); ?></dt>
		<dd>
			<?php echo h($rolestate['Rolestate']['accessit']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rolestate'), array('action' => 'edit', $rolestate['Rolestate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rolestate'), array('action' => 'delete', $rolestate['Rolestate']['id']), array(), __('Are you sure you want to delete # %s?', $rolestate['Rolestate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rolestates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rolestate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>

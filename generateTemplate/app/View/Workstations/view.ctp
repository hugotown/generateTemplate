<div class="workstations view">
<h2><?php echo __('Workstation'); ?></h2>
	<dl>
		<dt><?php echo __('CreatedAt'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['createdAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedAt'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['updatedAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedBy'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['createdBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedBy'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['updatedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lov Workstation Role'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['lov_workstation_role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('EmployeeNumber'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['employeeNumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Workarea Id'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['workarea_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Workstation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workstation['ParentWorkstation']['name'], array('controller' => 'workstations', 'action' => 'view', $workstation['ParentWorkstation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Building'); ?></dt>
		<dd>
			<?php echo $this->Html->link($workstation['Building']['name'], array('controller' => 'buildings', 'action' => 'view', $workstation['Building']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workstation['Workstation']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workstation'), array('action' => 'edit', $workstation['Workstation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workstation'), array('action' => 'delete', $workstation['Workstation']['id']), array(), __('Are you sure you want to delete # %s?', $workstation['Workstation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workstation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('controller' => 'workstations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($workstation['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('CreatedAt'); ?></th>
		<th><?php echo __('UpdatedAt'); ?></th>
		<th><?php echo __('CreatedBy'); ?></th>
		<th><?php echo __('UpdatedBy'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('FirstName'); ?></th>
		<th><?php echo __('LastName'); ?></th>
		<th><?php echo __('Lov User Gender'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Workstation Id'); ?></th>
		<th><?php echo __('Lov User Status'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($workstation['User'] as $user): ?>
		<tr>
			<td><?php echo $user['createdAt']; ?></td>
			<td><?php echo $user['updatedAt']; ?></td>
			<td><?php echo $user['createdBy']; ?></td>
			<td><?php echo $user['updatedBy']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['firstName']; ?></td>
			<td><?php echo $user['lastName']; ?></td>
			<td><?php echo $user['lov_user_gender']; ?></td>
			<td><?php echo $user['group_id']; ?></td>
			<td><?php echo $user['workstation_id']; ?></td>
			<td><?php echo $user['lov_user_status']; ?></td>
			<td><?php echo $user['id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Workstations'); ?></h3>
	<?php if (!empty($workstation['ChildWorkstation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('CreatedAt'); ?></th>
		<th><?php echo __('UpdatedAt'); ?></th>
		<th><?php echo __('CreatedBy'); ?></th>
		<th><?php echo __('UpdatedBy'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Lov Workstation Role'); ?></th>
		<th><?php echo __('EmployeeNumber'); ?></th>
		<th><?php echo __('Workarea Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($workstation['ChildWorkstation'] as $childWorkstation): ?>
		<tr>
			<td><?php echo $childWorkstation['createdAt']; ?></td>
			<td><?php echo $childWorkstation['updatedAt']; ?></td>
			<td><?php echo $childWorkstation['createdBy']; ?></td>
			<td><?php echo $childWorkstation['updatedBy']; ?></td>
			<td><?php echo $childWorkstation['name']; ?></td>
			<td><?php echo $childWorkstation['lov_workstation_role']; ?></td>
			<td><?php echo $childWorkstation['employeeNumber']; ?></td>
			<td><?php echo $childWorkstation['workarea_id']; ?></td>
			<td><?php echo $childWorkstation['status']; ?></td>
			<td><?php echo $childWorkstation['parent_id']; ?></td>
			<td><?php echo $childWorkstation['building_id']; ?></td>
			<td><?php echo $childWorkstation['description']; ?></td>
			<td><?php echo $childWorkstation['id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'workstations', 'action' => 'view', $childWorkstation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'workstations', 'action' => 'edit', $childWorkstation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'workstations', 'action' => 'delete', $childWorkstation['id']), array(), __('Are you sure you want to delete # %s?', $childWorkstation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

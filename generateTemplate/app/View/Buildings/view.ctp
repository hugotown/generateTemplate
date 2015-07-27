<div class="buildings view">
<h2><?php echo __('Building'); ?></h2>
	<dl>
		<dt><?php echo __('CreatedAt'); ?></dt>
		<dd>
			<?php echo h($building['Building']['createdAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedAt'); ?></dt>
		<dd>
			<?php echo h($building['Building']['updatedAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedBy'); ?></dt>
		<dd>
			<?php echo h($building['Building']['createdBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedBy'); ?></dt>
		<dd>
			<?php echo h($building['Building']['updatedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($building['Building']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($building['Building']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TaxNumber'); ?></dt>
		<dd>
			<?php echo h($building['Building']['taxNumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manager'); ?></dt>
		<dd>
			<?php echo h($building['Building']['manager']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($building['Building']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($building['Building']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($building['Building']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Building'), array('action' => 'edit', $building['Building']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Building'), array('action' => 'delete', $building['Building']['id']), array(), __('Are you sure you want to delete # %s?', $building['Building']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('controller' => 'workstations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Workstations'); ?></h3>
	<?php if (!empty($building['Workstation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('CreatedAt'); ?></th>
		<th><?php echo __('UpdatedAt'); ?></th>
		<th><?php echo __('CreatedBy'); ?></th>
		<th><?php echo __('UpdatedBy'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Role'); ?></th>
		<th><?php echo __('EmployeeNumber'); ?></th>
		<th><?php echo __('Workarea'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($building['Workstation'] as $workstation): ?>
		<tr>
			<td><?php echo $workstation['createdAt']; ?></td>
			<td><?php echo $workstation['updatedAt']; ?></td>
			<td><?php echo $workstation['createdBy']; ?></td>
			<td><?php echo $workstation['updatedBy']; ?></td>
			<td><?php echo $workstation['name']; ?></td>
			<td><?php echo $workstation['role']; ?></td>
			<td><?php echo $workstation['employeeNumber']; ?></td>
			<td><?php echo $workstation['workarea']; ?></td>
			<td><?php echo $workstation['status']; ?></td>
			<td><?php echo $workstation['parent_id']; ?></td>
			<td><?php echo $workstation['building_id']; ?></td>
			<td><?php echo $workstation['description']; ?></td>
			<td><?php echo $workstation['id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'workstations', 'action' => 'view', $workstation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'workstations', 'action' => 'edit', $workstation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'workstations', 'action' => 'delete', $workstation['id']), array(), __('Are you sure you want to delete # %s?', $workstation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

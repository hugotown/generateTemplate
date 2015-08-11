<div class="workareas view">
<h2><?php echo __('Workarea'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedBy'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['createdBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedBy'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['updatedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedAt'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['createdAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedAt'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['updatedAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($workarea['Workarea']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Workarea'), array('action' => 'edit', $workarea['Workarea']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Workarea'), array('action' => 'delete', $workarea['Workarea']['id']), array(), __('Are you sure you want to delete # %s?', $workarea['Workarea']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Workareas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workarea'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Workstations'), array('controller' => 'workstations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Workstation'), array('controller' => 'workstations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Workstations'); ?></h3>
	<?php if (!empty($workarea['Workstation'])): ?>
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
	<?php foreach ($workarea['Workstation'] as $workstation): ?>
		<tr>
			<td><?php echo $workstation['createdAt']; ?></td>
			<td><?php echo $workstation['updatedAt']; ?></td>
			<td><?php echo $workstation['createdBy']; ?></td>
			<td><?php echo $workstation['updatedBy']; ?></td>
			<td><?php echo $workstation['name']; ?></td>
			<td><?php echo $workstation['lov_workstation_role']; ?></td>
			<td><?php echo $workstation['employeeNumber']; ?></td>
			<td><?php echo $workstation['workarea_id']; ?></td>
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

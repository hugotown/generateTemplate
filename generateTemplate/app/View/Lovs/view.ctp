<div class="lovs view">
<h2><?php echo __('Lov'); ?></h2>
	<dl>
		<dt><?php echo __('CreatedAt'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['createdAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedAt'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['updatedAt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedBy'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['createdBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UpdatedBy'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['updatedBy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OrderShow'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['orderShow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LovType'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['lovType']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name '); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['name_']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Es MX'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['name_es_MX']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name En US'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['name_en_US']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Lov'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lov['ParentLov']['id'], array('controller' => 'lovs', 'action' => 'view', $lov['ParentLov']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lov['Lov']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lov'), array('action' => 'edit', $lov['Lov']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lov'), array('action' => 'delete', $lov['Lov']['id']), array(), __('Are you sure you want to delete # %s?', $lov['Lov']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lovs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lov'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lovs'), array('controller' => 'lovs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Lov'), array('controller' => 'lovs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Lovs'); ?></h3>
	<?php if (!empty($lov['ChildLov'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('CreatedAt'); ?></th>
		<th><?php echo __('UpdatedAt'); ?></th>
		<th><?php echo __('CreatedBy'); ?></th>
		<th><?php echo __('UpdatedBy'); ?></th>
		<th><?php echo __('OrderShow'); ?></th>
		<th><?php echo __('LovType'); ?></th>
		<th><?php echo __('Name '); ?></th>
		<th><?php echo __('Name Es MX'); ?></th>
		<th><?php echo __('Name En US'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lov['ChildLov'] as $childLov): ?>
		<tr>
			<td><?php echo $childLov['createdAt']; ?></td>
			<td><?php echo $childLov['updatedAt']; ?></td>
			<td><?php echo $childLov['createdBy']; ?></td>
			<td><?php echo $childLov['updatedBy']; ?></td>
			<td><?php echo $childLov['orderShow']; ?></td>
			<td><?php echo $childLov['lovType']; ?></td>
			<td><?php echo $childLov['name_']; ?></td>
			<td><?php echo $childLov['name_es_MX']; ?></td>
			<td><?php echo $childLov['name_en_US']; ?></td>
			<td><?php echo $childLov['status']; ?></td>
			<td><?php echo $childLov['parent_id']; ?></td>
			<td><?php echo $childLov['id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'lovs', 'action' => 'view', $childLov['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lovs', 'action' => 'edit', $childLov['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lovs', 'action' => 'delete', $childLov['id']), array(), __('Are you sure you want to delete # %s?', $childLov['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Lov'), array('controller' => 'lovs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

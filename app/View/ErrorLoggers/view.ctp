<div class="errorLoggers view">
<h2><?php echo __('Error Logger'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LineNo'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['lineNo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FileName'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['fileName']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Context'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['context']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('StackTrace'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['stackTrace']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CreatedOn'); ?></dt>
		<dd>
			<?php echo h($errorLogger['ErrorLogger']['createdOn']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Error Logger'), array('action' => 'edit', $errorLogger['ErrorLogger']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Error Logger'), array('action' => 'delete', $errorLogger['ErrorLogger']['id']), array(), __('Are you sure you want to delete # %s?', $errorLogger['ErrorLogger']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Error Loggers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Error Logger'), array('action' => 'add')); ?> </li>
	</ul>
</div>

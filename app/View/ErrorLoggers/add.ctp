<div class="errorLoggers form">
<?php echo $this->Form->create('ErrorLogger'); ?>
	<fieldset>
		<legend><?php echo __('Add Error Logger'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('lineNo');
		echo $this->Form->input('message');
		echo $this->Form->input('fileName');
		echo $this->Form->input('context');
		echo $this->Form->input('x');
		echo $this->Form->input('stackTrace');
		echo $this->Form->input('createdOn');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Error Loggers'), array('action' => 'index')); ?></li>
	</ul>
</div>

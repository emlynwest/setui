<li class="setui-leaf <?php echo ($active) ? 'setui-active setui-open' : ''; ?>"
	id="setui_<?php echo $node->tree_id.'_'.$node->id; ?>"
	>

	<a href="<?php echo $url; ?>"><?php echo $name; ?></a>

	<?php if (!empty($branches))
	{
		echo Asset::img('triangle.png', [
			'class' => 'setui-link',
			'data-parent' => 'setui_' . $node->tree_id . '_' . $node->id
		]);
	}
	?>

	<?php echo $branches; ?>
</li>

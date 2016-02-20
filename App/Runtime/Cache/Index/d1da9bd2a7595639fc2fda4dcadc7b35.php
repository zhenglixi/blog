<?php if (!defined('THINK_PATH')) exit();?><dl>
	<dt>最新布发</dt>
	<?php if(is_array($latest)): foreach($latest as $key=>$v): ?><dd>
			<a href="<?php echo U('/' . $v['id']);?>" target='_blank'><?php echo ($v["title"]); ?></a>
			<span><?php echo ($v["click"]); ?></span>
		</dd><?php endforeach; endif; ?>
</dl>
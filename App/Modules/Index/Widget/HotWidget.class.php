<?php

Class HotWidget extends Widget {

	public function render ($data) {
		// 热门博文
		$field = array('id', 'title', 'click');
		$blog = M('blog')->field($field)->limit(5)->order('click DESC')->select();
		// p($blog);
		$data['blog'] = $blog;
		return $this->renderFile('',$data);
	}
}
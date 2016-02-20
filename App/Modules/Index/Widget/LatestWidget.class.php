<?php

Class LatestWidget extends Widget {

	public function render ($data) {
		// 最新发布
		$field = array('id', 'title', 'click');
		$limit = $data['limit'];
		$data['latest'] = M('blog')->field($field)->limit($limit)->order('time DESC')->select();
		return $this->renderFile('',$data);
	}
}
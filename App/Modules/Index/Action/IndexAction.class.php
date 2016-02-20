<?php
/**
 * 前台首页控制器
 */
Class IndexAction extends Action {
    // 前台首页
    public function index(){
    	if (!$list = S('index_list')) {
	    	$list = M('cate')->where(array('pid' =>0))->order('sort')->select();
	    	// p($list);
	    	import('Class.Category', APP_PATH);
	    	$cate = M('cate')->order('sort')->select();
	    	$db = M('blog');
	    	$field = array('id', 'title', 'time');

	    	foreach ($list as $k => $v) {
	    		$cids = Category::getChildrenId($cate,$v['id']);
	    		$cids[] = $v['id'];
	    		$where = array('cid' => array('IN',$cids));
	    		$list[$k]['blog'] = $db->field($field)->where($where)->order('time DESC')->select();
	    	}
    	}    	
    	// p($list);
    	S('index_list', $list, 10);
    	$this->cate = $list;
    	$this->display();
    }
}
?>
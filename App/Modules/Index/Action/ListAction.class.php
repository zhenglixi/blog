<?php
/**
 * 前台列表控制器
 */
Class ListAction extends Action {
    // 前台列表
    public function index() {
    	import('Class.Category', APP_PATH);
    	import('ORG.Util.Page');
    	$id = (int) $_GET['id'];
    	$cate = M("cate")->order('sort')->select();
    	$cids = Category::getChildrenId($cate, $id);
    	$cids[] = $id;

    	$where = array('cid' => array('IN', $cids));
    	$count = M('blog')->where($where)->count();
    	// echo $count;die;
    	$page = new Page($count, 5);
    	$limit = $page->firstRow . ',' . $page->listRows;
    	// echo $limit;die;

    	$blog = D('BlogView')->getAll($where, $limit);
    	// p($cids);
    	// p($cate);die;
    	// p($blog);die;
    	$this->blog = $blog;
    	$this->page = $page->show();
    	$this->display();
    }

}
?>
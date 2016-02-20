<?php
/**
 * 前台展示控制器
 */
Class ShowAction extends Action {
    // 前台展示
    public function index(){
    	$id = (int) $_GET['id'];

    	$field = array('id','title','content', 'time', 'cid');
    	$this->blog = M('blog')->field($field)->find($id);

    	$cid = $this->blog['cid'];
    	import('Class.Category',APP_PATH);
    	$cate = M('cate')->order('sort')->select();
    	$this->parent = Category::getParents($cate,$cid);

    	$this->display();
    }

    public function clickCounter() {
    	$id = (int) $_GET['id'];
    	$where = array('id' => $id);
    	M('blog')->where($where)->setInc('click'); // setInc($field,$step),默认$step=1。
    	$click = M('blog')->where($where)->getField('click');
    	echo 'document.write(' . $click . ')';
    }
}
?>
<?php
/**
 * 后台首页控制器
 */
Class SystemAction extends CommonAction {
    // 后台首页
    public function verify(){
    	$this->display();
    }

    public function UpdataVerify() {
    	if (F('verify',$_POST,CONF_PATH)) {
    		$this->success('修改成功', U(GROUP_NAME . '/System/verify'));
    	}else{
    		$this->error('修改失败');
    	}
    }
}
?>
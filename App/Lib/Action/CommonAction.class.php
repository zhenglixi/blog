<?php

Class CommonAction extends Action {

	public function _initialize() {
		if (!isset($_SESSION[C('USER_AUTH_KEY')]) || !isset($_SESSION['username'])){
			$this->redirect(GROUP_NAME . '/Login/index');
		}
	}
}
?>
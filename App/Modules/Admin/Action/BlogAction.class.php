<?php 

class BlogAction extends CommonAction {

	// 博文列表
	public function index()	{
		$blog = D('BlogRelation')->getBlogs();
		// p($blog);die;
		$this->blog = $blog;
		$this->display();
	}

	// 删除/还原 到回收站
	public function remove() {
		$type = (int) $_GET['type'];
		$msg = $type ? '删除' : '还原';
		$update = array(
			'id' => (int) $_GET['id'],
			'del' => $type
			);
		if (M('blog')->save($update)) {
			$this->success($msg . '成功',U(GROUP_NAME . '/Blog/index'));
		}else{
			$this->error($msg . '失败');
		}
	}

	// 彻底删除
	public function delete() {
		$id = (int) $_GET['id'];
		// D('BlogRelation')->relation('attr')->delete($id);
		// $this->display('index');
		if (M('blog')->delete($id)) {
			M('blog_attr')->where(array('bid'=>$id))->delete();
			$this->success('删除成功',U(GROUP_NAME . '/Blog/trash'));
		}else{
			$this->error('删除失败');
		}
	}

	public function purge()	{
		$blog = D('BlogRelation')->getBlogs(1);
		foreach ($blog as $v) {
			if (M('blog')->delete($v['id'])) {
				M('blog_attr')->where(array('bid'=>$v['id']))->delete();				
			}else{
				$this->error('回收站清空失败');
			}
		}
		$this->success('回收站已经清空',U(GROUP_NAME . '/Blog/trash'));
	}

	// 回收站
	public function trash () {
		$blog = D('BlogRelation')->getBlogs(1);
		// p($blog);
		$this->blog = $blog;
		$this->display('index');
	}

	// 添加博文
	public function blog() {
		// 博文所属分类
		import('Class.Category', APP_PATH);
		$cate = M('cate')->order('sort')->select();
		$this->cate = Category::unlimitedForLevel($cate);
		// p($cate);die;
		// 博文属性
		$attr = M('attr')->select();
		// p($attr);die;
		$this->assign('attr',$attr)->display();
	}

	// 添加博文表单处理
	public function addBlog() {
		// p($_POST);
		$data = array(
			'title' => $_POST['title'],
			'summary' => $_POST['summary'],
			'content' => $_POST['content'],
			'time' => time(),
			'click' => (int) $_POST['click'],
			'cid' => (int) $_POST['cid'],
			);
		if ($bid = M('blog')->add($data)) {

			if (isset($_POST['aid'])) {
				$sql = 'INSERT INTO`' . C('DB_PREFIX') . 'blog_attr` (bid,aid) VALUES';
				foreach ($_POST['aid'] as $v) {
					$sql .= '(' . $bid . ',' . $v .'),';
				}
				$sql = rtrim($sql,',');
				M('blog_attr')->query($sql);
			}
			// echo $sql;
			$this->success('添加成功', U(GROUP_NAME . '/Blog/index'));
		}else{
			$this->error('添加失败');
		}
	}

	// 编辑器图片上传处理
	public function upload () {
        date_default_timezone_set("Asia/chongqing");
        error_reporting(E_ERROR);
        header("Content-Type: text/html; charset=utf-8");
        
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("./Data/Ueditor/php/config.json")), true);
        $action = $_GET['action'];
        switch ($action) {
            case 'config':
                $result =  json_encode($CONFIG);
                break;
        
                /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                //$result = include("action_upload.php");
                import('ORG.Net.UploadFile');
                $upload = new UploadFile();
                $upload->autoSub = true;
                $upload->subType = 'date';
                $upload->dateFormat = 'Ym';

                if ($upload->upload('./Uploads/')){
                    $info = $upload->getUploadFileInfo();
                    import('ORG.Util.Image');
                    Image::water('./Uploads/' . $info[0]['savename'], './Data/logo.png');
                    // import('Class.Image', APP_PATH);
                    // Image::water('./Uploads/' . $info[0]['savename']);
                    
                    echo json_encode(array(
                            'url'        =>    __ROOT__.'/Uploads/'.$info[0]['savename'],
                            'title'        =>    htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
                            'original'    =>    $info[0]['name'],
                            'state'        =>    'SUCCESS'
                            ));
                    
                }else{
                    echo json_encode(array(
                            'state'    => $upload->getErrorMsg(),
                            ));
                }
                break;
        }
        
        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                        'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }
}
 ?>
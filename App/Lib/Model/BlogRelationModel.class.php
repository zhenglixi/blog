<?php 

Class BlogRelationModel extends RelationModel {

	protected $tableName = 'blog';

	protected $_link = array(
		'attr' => array(
			'mapping_type' => MANY_TO_MANY,
			'mapping_name' => 'attr',
			'foreign_key' => 'bid',
			'relation_foreign_key' => 'aid',
			'relation_table' => 'hd_blog_attr',
			),
		'cate' => array(
			'mapping_type' => BELONGS_TO, // 多对一·
			'foreign_key' => 'cid', // 外键'cid'
			'mapping_fields'=>'name', // 只读取'name'
			'as_fields' => 'name:cate', // 拼入'blog','name'改名'cate'(避免重名)
			)
		);

	public function getBlogs($type = 0) {
		$field = array('del'); // 指定范围。然后在field($field,true)中加'true'表示'剔除'。
		$where = array('del' => $type); // 判断放入回收站没有
		return $this->field($field,true)->where($where)->relation(true)->select(); // 关联'attr':relation('attr');全部关联:relation(true)
	}
}
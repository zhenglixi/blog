<?php 

Class Category{
	// 组合一维数组
	Static public function unlimitedForLevel ($cate, $dash = '__', $pid = 0, $level = 0) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v['level'] = $level + 1;
				$v['dash'] = str_repeat($dash, $level);
				$arr[] = $v;
				$arr = array_merge($arr,self::unlimitedForLevel($cate, $dash, $v['id'], $level + 1));
			}
		}
		return $arr;
	}
	// 组合多维数组
	Static public function unlimitedForLayer ($cate, $name = 'child', $pid = 0) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$v[$name] = self::unlimitedForLayer($cate, $name, $v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}
	// 返回子级分类ID的所有父级分类
	Static public function getParents ($cate, $id) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['id'] == $id) {
				$arr[] = $v;
				$arr = array_merge(self::getParents($cate, $v['pid']), $arr);
			}
		}
		return $arr;
	}
	// 返回父级分类ID的所有子级分类ID
	Static public function getChildrenId ($cate, $pid) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$arr[] = $v['id'];
				$arr = array_merge($arr, self::getChildrenId($cate, $v['id']));
			}
		}
		return $arr;
	}
	// 返回父级分类ID的所有子级分类
	Static public function getChildren ($cate, $pid) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] == $pid) {
				$arr[] = $v;
				$arr = array_merge($arr, self::getChildren($cate, $v['id']));
			}
		}
		return $arr;
	}
}
?>
<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-26 15:04:56
 * @version $Id$
 */

class AttributeModel extends Model {
	//分页获取指定类型下的所有属性
	public function getPageAttrs($type_id,$offset,$pagesize)
    {
    	$type_table = $GLOBALS['config']['prefix'] . 'goods_type';
    	if($type_id == 0){
    		$sql = "SELECT * FROM {$this->table} AS a INNER JOIN $type_table AS b ON a.type_id = b.type_id ORDER BY attr_id DESC LIMIT $offset,$pagesize";
    		
    	}else{
			$sql = "SELECT * FROM {$this->table} AS a INNER JOIN $type_table AS b ON a.type_id = b.type_id WHERE a.type_id=$type_id ORDER BY attr_id DESC LIMIT $offset,$pagesize";
    	}
    	$this->db->setSql($sql);
    	return $this->db->fetchAll();
    }
    
    //获取指定类型下的所有属性并生成表格
    public function getAttrsTable($type_id)
    {
        $attrs = $this->getAll(['where'=>"type_id=$type_id"]); //二维数组
        $res = "<table width='100%' id='attrTable'>";
        foreach ($attrs as $attr) {
            $res .= "<tr>";
            $res .= "<td class='label'>".$attr['attr_name']."</td>";
            $res .= "<td>";
            $res .= "<input type='hidden' name='attr_id_list[]' value={$attr['attr_id']}'>";
            switch ($attr['attr_input_type']) {
                case 0:  #单行文本框
                    $res .= "<input name='attr_value_list[]' type='text' size='40'>";
                    break;
                case 1:  #下拉列表
                    $res .= "<select name='attr_value_list[]'>";
                    $res .= "<option value=''>请选择...</option>";
                    $opts = explode(PHP_EOL, $attr['attr_value']);
                    foreach ($opts as $opt) {
                        $res .= "<option value='$opt'>".$opt."</option>";
                    }
                    $res .= "</select>";
                    break;
                case 2:  #多行文本框
                    $res .= "<textarea name='attr_value_list[]' cols='30' rows='10'></textarea>";
                    break;
            }
            $res .= "<input type='hidden' name='attr_price_list[]' value='0'>";
            $res .= "</td>";
            $res .= "</tr>";
        }
        $res .="</table>";
        return $res;
    }

    //获取所有属性及对应分类名
    public function getAttrType()
    {
        $type_table = $GLOBALS['config']['prefix'] . 'goods_type';
        $sql = "SELECT a.*,b.type_name FROM {$this->table} AS a INNER JOIN {$type_table} AS b ON a.type_id=b.type_id GROUP BY b.type_name";
        $this->db->setSql($sql);
        return $this->db->fetchAll();
    }
}
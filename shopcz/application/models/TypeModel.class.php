<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-09-26 10:32:33
 * @version $Id$
 */

class TypeModel extends Model {
	public function getTypeAttrs($offset,$pagesize)
	{
		$attr_table = $GLOBALS['config']['prefix'] . 'attribute';
		$sql = "SELECT t.*,count(attr_id) as type_count FROM {$this->table} AS t left JOIN $attr_table  AS a ON t.type_id=a.type_id GROUP BY type_name ORDER BY type_id LIMIT $offset,$pagesize";
		$this->db->setSql($sql);
		return $this->db->fetchAll();
	}
}
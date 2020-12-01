<?php
// Copyright (c) 2020 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Class ilDclTimesFieldModel
 */
class ilDclTimesFieldModel extends ilDclPluginFieldModel {
	/**
	 * @param int $a_id
	 */
	public function __construct($a_id = 0) {
		parent::__construct($a_id);

		// if you want to use the dcl-storage locations you need to override the plugins default one (which is no location)
		$this->setStorageLocationOverride(1);
	}

	/**
	 * Returns a query-object for building the record-loader-sql-query
	 *
	 * @param string $filter_value
	 *
	 * @return null|ilDclRecordQueryObject
	 */
	public function getRecordQueryFilterObject($filter_value = "", ilDclBaseFieldModel $sort_field = null) {
		global $ilDB;

		$join_str = "INNER JOIN il_dcl_record_field AS filter_record_field_{$this->getId()} ON (filter_record_field_{$this->getId()}.record_id = record.id AND filter_record_field_{$this->getId()}.field_id = " . $ilDB->quote($this->getId(), 'integer') . ") ";
		$join_str .= "INNER JOIN il_dcl_stloc{$this->getStorageLocation()}_value AS filter_stloc_{$this->getId()} ON (filter_stloc_{$this->getId()}.record_field_id = filter_record_field_{$this->getId()}.id AND filter_stloc_{$this->getId()}.value LIKE " . $ilDB->quote("%$filter_value%", 'text') . ") ";

		$sql_obj = new ilDclRecordQueryObject();
		$sql_obj->setJoinStatement($join_str);

		return $sql_obj;
	}
}
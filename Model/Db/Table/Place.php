<?php

class Job_Model_Db_Table_Place extends Core_Model_Db_Table {

    protected $_name = "job_place";
    protected $_primary = "place_id";

    /**
     * @param $values
     * @param $order
     * @param $params
     * @return array
     */
    public function findActive($values, $order, $params) {
        $select = $this->_db->select()
            ->from(array("place" => "job_place"))
            ->join(array("company" => "job_company"), "place.company_id = company.company_id", array("company_logo" => "logo", "company_name" => "name", "company_location" => "location"))
            ->where("company.is_active = ?", true)
            ->where("place.is_active = ?", true)
            ->where("company.value_id = ?", $values["value_id"])
        ;

        return $this->_db->fetchAll($select, $order, $params["limit"], $params["offset"]);
    }
}

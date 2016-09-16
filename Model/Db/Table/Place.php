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
            ->from(array("place" => "job_place"), array("*", "time" => "UNIX_TIMESTAMP(place.created_at)"))
            ->join(array("company" => "job_company"), "place.company_id = company.company_id", array("company_logo" => "logo", "company_name" => "name", "company_location" => "location"))
            ->join(array("job" => "job"), "job.job_id = company.job_id")
            ->where("company.is_active = ?", true)
            ->where("place.is_active = ?", true)
            ->where("job.value_id = ?", $values["value_id"])
            ->order($order)
            ->limit($params["limit"])
        ;

        if(isset($values["time"]) && ($values["time"] > 0)) {
            if($values["pull_to_refresh"]) {
                $select->where("UNIX_TIMESTAMP(place.created_at) > ?", $values["time"]);
            } else {
                $select->where("UNIX_TIMESTAMP(place.created_at) < ?", $values["time"]);
            }
        }

        return $this->_db->fetchAll($select);
    }
}

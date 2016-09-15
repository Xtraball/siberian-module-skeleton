<?php
/**
 * Class Job_Form_Place_Toggle
 */
class Job_Form_Place_Toggle extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $this
            ->setAction(__path("/job/application/togglejobpost"))
            ->setAttrib("id", "form-place-toggle")
        ;

        /** Bind as a delete form */
        self::addClass("toggle", $this);

        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
            ->from('job_place')
            ->where('job_place.place_id = :value')
        ;

        $place_id = $this->addSimpleHidden("place_id", __("Place"));
        $place_id->addValidator("Db_RecordExists", true, $select);
        $place_id->setMinimalDecorator();

        $this->addMiniSubmit(null, "<i class='fa fa-power-off'></i>", "<i class='fa fa-check'></i>");

        $this->defaultToggle($this->mini_submit, "Enable place", "Disable place");
    }
}
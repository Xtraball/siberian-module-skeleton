<?php
/**
 * Class Job_Form_Place
 */
class Job_Form_Place extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $this
            ->setAction(__path("/job/application/editplacepost"))
            ->setAttrib("id", "form-place")
            ->addNav("job-place-nav");
        ;

        /** Bind as a create form */
        self::addClass("create", $this);

        $logo = $this->addSimpleImage("banner", __("Header"), __("Import a header image"), array("width" => 1200, "height" => 400, "required" => true));

        $name = $this->addSimpleText("name", __("Name"));
        $name
            ->setRequired(true)
        ;

        $description = $this->addSimpleTextarea("description", __("Description"));
        $description->setRequired(true);


        $address = $this->addSimpleText("location", __("Address"));
        $address
            ->setRequired(true)
        ;

        $company = $this->addSimpleSelect("company_id", __("Company"));
        $company->setRequired(true);

        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
            ->from('job_company')
            ->where('job_company.company_id = :value')
        ;
        $company->addValidator("Db_RecordExists", true, $select);
        $company->setRegisterInArrayValidator(false);

        $income_from = $this->addSimpleText("income_from", __("Income from:"));
        $income_to = $this->addSimpleText("income_to", __("to:"));

        $value_id = $this->addSimpleHidden("value_id");
        $value_id
            ->setRequired(true)
        ;
    }
}
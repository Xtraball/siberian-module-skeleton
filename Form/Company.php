<?php
/**
 * Class Job_Form_Company
 */
class Job_Form_Company extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $this
            ->setAction(__path("/job/company/editpost"))
            ->setAttrib("id", "form-company")
            ->setAttrib("autocomplete", "off")
            ->addNav("job-company-nav")
        ;

        /** Bind as a create form */
        self::addClass("create", $this);

        $this->addSimpleHidden("company_id");

        $name = $this->addSimpleText("name", __("Name"));
        $name
            ->setRequired(true)
        ;

        $description = $this->addSimpleTextarea("description", __("Description"));
        $description
            ->setRequired(true)
            ->setNewDesignLarge()
            ->setRichtext()
        ;

        $email = $this->addSimpleText("email", __("E-mail"));
        $email
            ->addValidator("EmailAddress")
            ->setRequired(true)
            ->setAttrib("autocomplete", "job-company-email")
        ;

        $password = $this->addSimplePassword("_password_", __("Password"));
        $password->setDescription(__("By setting up a password, this company can use the API to manage it's account & places.<br />Leave blank to disable the API access."));

        $address = $this->addSimpleText("location", __("Address"));
        $address
            ->setRequired(true)
        ;

        $employees = $this->addSimpleText("employee_count", __("Employee count"));
        
        $logo = $this->addSimpleImage("logo", __("Logo"), __("Import a logo"), array("width" => 500, "height" => 500, "required" => true));
        $header = $this->addSimpleImage("header", __("Header"), __("Import a header"), array("width" => 1200, "height" => 400, "required" => true));

        $job_id = $this->addSimpleHidden("job_id");
        $job_id
            ->setRequired(true)
        ;

        $value_id = $this->addSimpleHidden("value_id");
        $value_id
            ->setRequired(true)
        ;
    }

    public function setCompanyId($company_id) {
        $this->getElement("company_id")->setValue($company_id)->setRequired(true);
    }
}
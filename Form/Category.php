<?php
/**
 * Class Job_Form_Category
 */
class Job_Form_Category extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $this
            ->setAction(__path("/job/application/editcategorypost"))
            ->setAttrib("id", "form-category")
            ->addNav("job-category-nav")
        ;

        /** Bind as a create form */
        self::addClass("create", $this);

        $this->addSimpleHidden("category_id");

        $name = $this->addSimpleText("name", __("Name"));
        $name
            ->setRequired(true)
        ;

        $description = $this->addSimpleTextarea("description", __("Description"));
        $description->setRequired(true);

        $email = $this->addSimpleText("email", __("E-mail"));
        $email
            ->addValidator("EmailAddress")
            ->setRequired(true)
        ;

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
<?php
/**
 * Class Job_Form_Test
 */
class Job_Form_Test extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $db = Zend_Db_Table::getDefaultAdapter();

        $this
            ->setAction(__path("/job/place/test"))
            ->setAttrib("id", "form-test")
            ->addNav("job-test-nav")
        ;

        /** Bind as a create form */
        self::addClass("create", $this);

        /** Hidden */
        $this->addSimpleHidden("element_hidden");

        /** Image upload with crop */
        $this->addSimpleImage("element_image", __("Image"), __("Import an image"), array("width" => 300, "height" => 300));

        /** Input text */
        $this->addSimpleText("element_text", __("Text"));

        /** Textarea */
        $this->addSimpleTextarea("element_textarea", __("Textarea"));

        /** Textara with CKEditor */
        $richtext = $this->addSimpleTextarea("element_textarea", __("Textarea"));
        $richtext->setRichtext();


        $this->addSimpleSelect("company_id", __("Company"));

    }
}
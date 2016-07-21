<?php
/**
 * Class Job_Form_Place
 */
class Job_Form_Place extends Siberian_Form_Abstract {

    public function init() {
        parent::init();

        $this
            ->setAction(__path("/job/application/placepost"))
            ->setAttrib("id", "form-place")
            ->addNav("job-place-nav");
        ;

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

        $value_id = $this->addSimpleHidden("value_id");
        $value_id->setRequired(true);
    }
}
<?php

class Job_ApplicationController extends Application_Controller_Default {

    /**
     * Simple edit post, validator
     */
    public function editcompanypostAction() {
        $values = $this->getRequest()->getPost();

        $form = new Job_Form_Company();
        if($form->isValid($values)) {
            /** Do whatever you need when form is valid */
            $company = new Job_Model_Company();
            $company->addData("job_id", $this->getCurrentOptionValue()->getId());
            $company->addData($values);

            $path_logo = Siberian_Feature::moveUploadedFile($this->getCurrentOptionValue(), Core_Model_Directory::getTmpDirectory()."/".$values['logo']);
            $path_header = Siberian_Feature::moveUploadedFile($this->getCurrentOptionValue(), Core_Model_Directory::getTmpDirectory()."/".$values['header']);
            $company->setData("logo", $path_logo);
            $company->setData("header", $path_header);
            $company->setData("is_active", true);
            $company->save();

            $html = array(
                "success" => 1,
                "message" => __("Success."),
            );
        } else {
            /** Do whatever you need when form is not valid */
            $html = array(
                "error" => 1,
                "message" => $form->getTextErrors(),
                "errors" => array_filter($form->getErrors())
            );
        }

        $this->getLayout()->setHtml(Zend_Json::encode($html));
    }

    /**
     * Simple edit post, validator
     */
    public function editplacepostAction() {
        $values = $this->getRequest()->getPost();

        $form = new Job_Form_Place();
        if($form->isValid($values)) {
            /** Do whatever you need when form is valid */
            $place = new Job_Model_Place();
            $place
                ->addData($values)
                ->addData(array(
                    "is_active" => true,
                ))
            ;

            $path_banner = Siberian_Feature::moveUploadedFile($this->getCurrentOptionValue(), Core_Model_Directory::getTmpDirectory()."/".$values['banner']);
            $place->setData("banner", $path_banner);
            $place->save();

            $place->save();

            $html = array(
                "success" => 1,
                "message" => __("Success."),
            );
        } else {
            /** Do whatever you need when form is not valid */
            $html = array(
                "error" => 1,
                "message" => $form->getTextErrors(),
                "errors" => array_filter($form->getErrors())
            );
        }

        $this->getLayout()->setHtml(Zend_Json::encode($html));
    }

    public function togglecompanypostAction() {

        if($company_id = $this->getRequest()->getParam("company_id")) {
            $company = new Job_Model_Company();
            $result = $company->find($company_id)->toggle();

            $html = array(
                "success" => 1,
                "message" => (!$result) ? __("Company disabled.") : __("Company enabled."),
            );
        } else {
            /** Do whatever you need when form is not valid */
            $html = array(
                "error" => 1,
                "message" => __("Missing company_id"),
            );
        }

        $this->_sendHtml($html);
    }

    public function togglejobpostAction() {

        if($place_id = $this->getRequest()->getParam("place_id")) {
            $place = new Job_Model_Place();
            $result = $place->find($place_id)->toggle();

            $html = array(
                "success" => 1,
                "message" => (!$result) ? __("Place disabled.") : __("Place enabled."),
            );
        } else {
            /** Do whatever you need when form is not valid */
            $html = array(
                "error" => 1,
                "message" => __("Missing place_id"),
            );
        }

        $this->_sendHtml($html);
    }

}
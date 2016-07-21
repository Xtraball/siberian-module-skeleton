<?php

class Job_ApplicationController extends Application_Controller_Default {

    /**
     * Simple edit post, validator
     */
    public function editpostAction() {
        $values = $this->getRequest()->getPost();

        $form = new Job_Form_Company();
        if($form->isValid($values)) {
            /** Do whatever you need when form is valid */
            $company = new Job_Model_Company();
            $company->addData("job_id", $this->getCurrentOptionValue()->getId());
            $company
                ->addData($values)
                ->save()
            ;

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

}
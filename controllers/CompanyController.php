<?php

class Job_CompanyController extends Core_Controller_Default
{
    public function deletepostAction() {

        if($id = $this->getRequest()->getParam('company_id')) {
            $company = new Job_Model_Company();
            $company->find($id);

            $company->delete();

            $data = array(
                'success' => 1,
                'success_message' => __('Company successfully deleted.'),
                'message_loader' => 0,
                'message_button' => 0,
                'message_timeout' => 2
            );
        }else{
            $data = array(
                'error' => 1,
                'message' => __('An error occurred while deleting the company. Please try again later.')
            );
        }

        $this->getLayout()->setHtml(Zend_Json::encode($data));

    }

}
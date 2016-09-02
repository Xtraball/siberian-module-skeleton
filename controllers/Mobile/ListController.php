<?php

class Job_Mobile_ListController extends Application_Controller_Mobile_Default {


    public function findallAction() {
        if($data = $this->getRequest()->getParams()) {
            try {

                if ($value_id = $this->getRequest()->getParam('value_id')) {
                    $offset = $this->getRequest()->getParam("offset", 0);
                    $place = new Job_Model_Place();
                    $places = $place->findActive(
                        array(
                            "value_id" => $value_id,
                            "is_active" => 1
                        ),
                        "created_at DESC",
                        array(
                            "offset" => $offset,
                            "limit" => Comment_Model_Comment::DISPLAYED_PER_PAGE
                        )
                    );

                    $collection = array();
                    foreach($places as $place) {
                        $collection[] = array(
                            "id" => $place->place_id,
                            "title" => $place->name,
                            "subtitle" => $place->description,
                            "company_logo" => ($place->logo) ? $this->getRequest()->getBaseUrl()."/images/application".$place->logo : null,
                        );
                    }

                }

                $html = array(
                    "success" => 1,
                    "collection" => $collection,
                    "page_title" => $this->getCurrentOptionValue()->getTabbarName(),
                );

            } catch(Exception $e) {
                $html = array(
                    "error" => 1,
                    "message" => $e->getMessage()
                );
            }

            $this->_sendHtml($html);
        }

    }

    public function findAction() {
        if($data = $this->getRequest()->getParams()) {
            try {

                if (($place_id = $this->getRequest()->getParam('place_id')) && ($value_id = $this->getRequest()->getParam('value_id'))) {
                    $place = new Job_Model_Place();
                    $place = $place->find(array(
                        "place_id" => $place_id,
                        "is_active" => true,
                    ));

                    if($place) {
                        $company = new Job_Model_Company();
                        $company->find($place->getCompanyId());

                        $place = array(
                            "id" => $place->getId(),
                            "title" => $place->getName(),
                            "subtitle" => $place->getDescription(),
                            "banner" => ($place->getBanner()) ? $this->getRequest()->getBaseUrl()."/images/application".$place->getBanner() : null,
                            "location" => $place->getLocation(),
                            "income_from" => $place->getIncomeFrom(),
                            "income_to" => $place->getIncomeTo(),
                            "company_id" => $place->getCompanyId(),
                            "company" => array(
                                "title" => $company->getName(),
                                "subtitle" => $company->getDescription(),
                                "location" => $company->getLocation(),
                                "email" => $company->getEmail(),
                                "logo" => ($company->getLogo()) ? $this->getRequest()->getBaseUrl()."/images/application".$company->getLogo() : null,
                            ),
                        );

                        $html = array(
                            "success" => 1,
                            "place" => $place,
                            "page_title" => $this->getCurrentOptionValue()->getTabbarName(),
                        );

                    }
                } else {
                    throw new Exception("#567-01: Missing value_id or place_id");
                }

            } catch(Exception $e) {
                $html = array(
                    "error" => 1,
                    "message" => $e->getMessage()
                );
            }

            $this->_sendHtml($html);
        }


    }

    /**public function pullmoreAction() {
        if($data = $this->getRequest()->getParams()) {

            try {
                $comment = new Comment_Model_Comment();
                $comments = $comment->pullMore($data['option_value_id'], $data['pos_id'], $data['from'], Comment_Model_Comment::DISPLAYED_PER_PAGE);

                $partial_comment = '';
                $partial_details = '';
                foreach($comments as $comment) :
                    $partial_comment .= $this->getLayout()->addPartial('comment_'.$comment->getId(), 'core_view_mobile_default', 'comment/l1/view/item.phtml')
                        ->setCurrentComment($comment)
                        ->toHtml()
                    ;
                    $partial_details .= $this->getLayout()->addPartial('comment_details_'.$comment->getId(), 'core_view_mobile_default', 'comment/l1/view/details.phtml')
                        ->setCurrentComment($comment)
                        ->toHtml()
                    ;
                endforeach;

                $html = array(
                    'success' => 1,
                    'comments' => $partial_comment,
                    'details' => $partial_details
                );

            } catch(Exception $e) {
                $html = array('error' => 1, 'message' => $e->getMessage());
            }

            $this->_sendHtml($html);

        }

    }*/

}
<?php

class Job_Mobile_ListController extends Application_Controller_Mobile_Default {

    public static $pager = 15;

    public function findallAction() {
        if($data = $this->getRequest()->getParams()) {
            try {

                if ($value_id = $this->getRequest()->getParam('value_id')) {
                    $time = $this->getRequest()->getParam("time", 0);
                    $pull_to_refresh = filter_var($this->getRequest()->getParam("pull_to_refresh", false), FILTER_VALIDATE_BOOLEAN);
                    $count = $this->getRequest()->getParam("count", 0);

                    $place = new Job_Model_Place();
                    $total = $place->findActive(
                        array(
                            "value_id" => $value_id,
                            "is_active" => 1
                        ),
                        "place.created_at DESC",
                        array(
                            "limit" => null
                        )
                    );
                    $places = $place->findActive(
                        array(
                            "value_id" => $value_id,
                            "time" => $time,
                            "pull_to_refresh" => $pull_to_refresh,
                            "is_active" => 1
                        ),
                        "place.created_at DESC",
                        array(
                            "limit" => self::$pager
                        )
                    );

                    $collection = array();

                    foreach($places as $place) {
                        $collection[] = array(
                            "id" => $place["place_id"],
                            "title" => $place["name"],
                            "subtitle" => strip_tags($place["description"]),
                            "location" => $place["location"],
                            "company_logo" => ($place["company_logo"]) ? $this->getRequest()->getBaseUrl()."/images/application".$place["company_logo"] : null,
                            "company_name" => $place["company_name"],
                            "time" => $place["time"],
                        );
                    }

                }

                $job = new Job_Model_Job();
                $job->find($value_id, "value_id");
                $options = array(
                    "display_search" => filter_var($job->getDisplaySearch(), FILTER_VALIDATE_BOOLEAN),
                    "display_place_icon" => filter_var($job->getDisplayPlaceIcon(), FILTER_VALIDATE_BOOLEAN),
                );

                $category = new Job_Model_Category();
                $categories = $category->findAll(array(
                    "job_id" => $job->getId(),
                    "is_active" => true,
                ));

                $all_categories = array();
                foreach($categories as $_category) {
                    $all_categories[] = array(
                        "title" => $_category->getName(),
                        "subtitle" => $_category->getDescription(),
                        "icon" => ($_category->getIcon()) ? $this->getRequest()->getBaseUrl()."/images/application".$_category->getIcon() : null,
                        "keywords" => $_category->getKeywords(),
                    );
                }
                $options = array(
                    "display_search" => filter_var($job->getDisplaySearch(), FILTER_VALIDATE_BOOLEAN),
                    "display_place_icon" => filter_var($job->getDisplayPlaceIcon(), FILTER_VALIDATE_BOOLEAN),
                );

                $html = array(
                    "success" => 1,
                    "collection" => $collection,
                    "options" => $options,
                    "categories" => $all_categories,
                    "more" => (count($total) > $count),
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
                                "subtitle" => strip_tags($company->getDescription()),
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

    public function findcompanyAction() {
        if($data = $this->getRequest()->getParams()) {
            try {

                if (($company_id = $this->getRequest()->getParam('company_id')) && ($value_id = $this->getRequest()->getParam('company_id'))) {
                    $company = new Job_Model_Company();
                    $company = $company->find(array(
                        "company_id" => $company_id,
                        "is_active" => true,
                    ));

                    if($company) {

                        $place = new Job_Model_Place();
                        $places = $place->findAll(array(
                            "company_id = ?" => $company->getId(),
                            "is_active = ?" => 1,
                        ));

                        $_places = array();
                        foreach($places as $place) {
                            $_places[] = array(
                                "id" => $place->getId(),
                                "title" => $place->getName(),
                                "subtitle" => html_entity_decode($place->getDescription()),
                                "banner" => ($place->getBanner()) ? $this->getRequest()->getBaseUrl()."/images/application".$place->getBanner() : null,
                                "location" => $place->getLocation(),
                                "income_from" => $place->getIncomeFrom(),
                                "income_to" => $place->getIncomeTo(),
                            );
                        }

                        $company = array(
                            "id" => $company->getId(),
                            "title" => $company->getName(),
                            "subtitle" => htmlspecialchars_decode($company->getDescription()),
                            "logo" => ($company->getLogo()) ? $this->getRequest()->getBaseUrl()."/images/application".$company->getLogo() : null,
                            "header" => ($company->getHeader()) ? $this->getRequest()->getBaseUrl()."/images/application".$company->getHeader() : null,
                            "location" => $company->getLocation(),
                            "employee_count" => $company->getEmployeeCount(),
                            "places" => $_places,
                        );

                        $html = array(
                            "success" => 1,
                            "company" => $company,
                            "page_title" => $this->getCurrentOptionValue()->getTabbarName(),
                        );

                    }
                } else {
                    throw new Exception("#567-02: Missing value_id or company_id");
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

}
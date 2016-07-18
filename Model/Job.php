<?php

class Job_Model_Job extends Core_Model_Default {

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
    }

    public function enable() {
        $this->is_active = true;
    }

    public function disable() {
        $this->is_active = false;
    }

    public function save() {
        parent::save();
    }
}
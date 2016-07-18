<?php
# Job module, data.
$name = "Job";
$category = "social";

# Icons
$icons = array(
    "/app/local/Job/media/library/job1.png",
    "/app/local/Job/media/library/job2.png",
);

$result = Siberian_Feature::installIcons($name, $icons);

# Install the Feature
$data = array(
    'library_id'                    => $result["library_id"],
    'icon_id'                       => $result["icon_id"],
    "code"                          => "job",
    "name"                          => $name,
    "model"                         => "Job_Model_Company",
    "desktop_uri"                   => "job/application/",
    "mobile_uri"                    => "job/mobile_list/",
    "mobile_view_uri"               => "job/mobile_view/",
    "mobile_view_uri_parameter"     => "company_id",
    "only_once"                     => 0,
    "is_ajax"                       => 1,
    "position"                      => 1000,
    "social_sharing_is_available"   => 1
);

$option = Siberian_Feature::install($category, $data);

# Layouts
$layout_data = array(1, 2);
$slug = "job";

Siberian_Feature::installLayouts($option->getId(), $slug, $layout_data);

# Icons Flat
$icons = array(
    "/app/local/Job/media/library/job1.png",
    "/app/local/Job/media/library/job2.png",
);

Siberian_Feature::installIcons("{$name}-flat", $icons);
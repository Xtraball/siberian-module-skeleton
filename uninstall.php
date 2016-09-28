<?php
# Job module un-installer.

$name = "Job";

# Clean-up library icons
Siberian_Feature::removeIcons($name);
Siberian_Feature::removeIcons("{$name}-flat");

# Clean-up Layouts
$layout_data = array(1);
$slug = "job";

Siberian_Feature::removeLayouts($option->getId(), $slug, $layout_data);

# Clean-up Option(s)/Feature(s)
$code = "job";
Siberian_Feature::uninstallFeature($code);

# Clean-up DB be really carefull with this.
$tables = array(
    "job",
    "job_company",
    "job_place",
    "job_place_contact",
    "job_category",
);
Siberian_Feature::dropTables($tables);

# Clean-up module
Siberian_Feature::uninstallModule($name);
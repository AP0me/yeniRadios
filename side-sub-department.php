<?php 
$_SERVER['sideSubDepartments'] = [
  0 => [
    "0Digital Content & Devices",
    "0Amazon Music",
    "0Kindle E-readers & Books",
    "0Amazon Appstore",
    "0Shop by Department"
  ],
  1 => [
    "1Digital Content & Devices",
    "1Amazon Music",
    "1Kindle E-readers & Books",
    "1Amazon Appstore",
    "1Shop by Department"
  ],
  2 => [
    "2Digital Content & Devices",
    "2Amazon Music",
    "2Kindle E-readers & Books",
    "2Amazon Appstore",
    "2Shop by Department"
  ],
  3 => [
    "3Digital Content & Devices",
    "3Amazon Music",
    "3Kindle E-readers & Books",
    "3Amazon Appstore",
    "3Shop by Department"
  ]
];

$sideSubDepartments = $_SERVER['sideSubDepartments'][$_GET['sideDepartmentID']];
for ($i=0; $i < count($sideSubDepartments); $i++) { 
  echo
  '<div class="all-side-row">
    <p>'.$sideSubDepartments[$i].'</p>
    <div> <!-- Just needed --> </div>
  </div>';
}

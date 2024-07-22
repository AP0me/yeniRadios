<?php 
$sideSubDepartments = json_decode($_GET['allSideSubDepartments'], true)[$_GET['departmentHeader']][$_GET['sideDepartmentID']];

for ($i=0; $i < count($sideSubDepartments); $i++) { 
  echo
  '<div class="all-side-row">
    <p>'.$sideSubDepartments[$i].'</p>
    <div> <!-- Just needed --> </div>
  </div>';
}

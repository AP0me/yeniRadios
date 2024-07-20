<?php
$_SERVER['sideDepartment'] = [
  "Digital Content & Devices" => [
    "Amazon Music",
    "Kindle E-readers & Books",
    "Amazon Appstore",
  ],
  "Shop by Department" => [
    "Electronics",
    "Computers",
    "Smart Home",
    "Arts & Crafts",
    "Automotive",
    "Baby",
    "Beauty and Personal Care",
    "Women's Fashion",
    "Men's Fashion",
    "Girls' Fashion",
    "Boys' Fashion",
    "Health and Household",
    "Home and Kitchen",
    "Industrial and Scientific",
    "Luggage",
    "Movies & Television",
    "Pet supplies",
    "Software",
    "Sports and Outdoors",
    "Tools & Home Improvement",
    "Toys and Games",
    "Video Games",
  ],
  "Programs & Features" => [
    "Gift Cards",
    "Shop By Interest",
    "Amazon Live",
    "International Shopping",
    "Amazon Second Chance",
  ],
  "Help & Settings" => [
    "Your Account",
    "English",
    "United States",
    "Customer Service",
  ],
];
$_SERVER['sideDepartmentHeaders'] = [
  "Digital Content & Devices",
  "Shop by Department",
  "Programs & Features",
  "Help & Settings",
];

?>
<div class="all-side" hidden >
  <div style="display: grid; height: 38px;">
    <i class="klbth-icon-angle-left all-side-back-arrow" onclick="scrollToMain()" isTransparent="yes"></i>
    <i class="klbth-icon-cancel all-side-cancel-btn" onclick="openCategories()"></i>
  </div>
  <div class="scroll-side" style="display: flex">
    <div class="main-side">
      <?php
      $_SERVER['sideDepartmentID'] = 0;
      for ($headerIndex=0; $headerIndex < count($_SERVER['sideDepartmentHeaders']); $headerIndex++) {
        $sideHeader = $_SERVER['sideDepartmentHeaders'][$headerIndex];
        echo "<strong class='all-side-row'>$sideHeader</strong><br >";
        for ($_SERVER['sideDepartmentID']=0; $_SERVER['sideDepartmentID'] < count($_SERVER['sideDepartment'][$sideHeader]); $_SERVER['sideDepartmentID']++) {
          include("side-department.php");
        }
        echo '<hr>';
      }
      ?>
    </div>
    <div class="sub-side"></div>
  </div>
</div>
<script>
  let subSide = document.querySelector(".sub-side");
  function fetchSubDepartmentData(departmentID) {
    fetch(`side-sub-department.php?sideDepartmentID=${departmentID}`)
      .then(response => {
        if (!response.ok) { throw new Error('Network response was not ok ' + response.statusText); }
        return response.text();
      })
      .then(data => {
        console.log(data);
        subSide.innerHTML = data;
        subDepartmentSwipe();
        // You can also update the DOM or perform other actions with the data
      })
      .catch(error => {
        console.error('There has been a problem with your fetch operation:', error);
      });
  }

  let scrollSide = document.querySelector(".scroll-side");
  let backArrow = document.querySelector(".all-side-back-arrow");
  let cancelBtn = document.querySelector(".all-side-cancel-btn");
  function subDepartmentSwipe(){
    console.log("subDepartmentSwipe");
    scrollSide.scrollTo({
      top: 0,
      left: 350,
      behavior: "smooth",
    });
    backArrow.setAttribute("isTransparent", "no");
    cancelBtn.setAttribute("isTransparent", "yes");
  }
  function scrollToMain(){
    console.log("scrollToMain");
    scrollSide.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth",
    });
    backArrow.setAttribute("isTransparent", "yes");
    cancelBtn.setAttribute("isTransparent", "no");
  }
  window.onbeforeunload = function () {
    scrollSide.scrollTo(0, 0);
  }
</script>
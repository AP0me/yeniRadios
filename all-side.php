<?php
$sideDepartment = [
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
$sideDepartmentHeaders = [
  "Digital Content & Devices",
  "Shop by Department",
  "Programs & Features",
  "Help & Settings",
];
?>
<div class="all-side" hidden >
  <div style="display: grid; height: 40px;">
    <i class="klbth-icon-angle-left all-side-back-arrow" onclick="scrollToMain()" isTransparent="yes"></i>
    <i class="klbth-icon-cancel all-side-cancel-btn" onclick="openCategories()"></i>
  </div>
  <div class="scroll-side">
    <div class="main-side" dontdisplay="no">
      <?php
      $sideDepartmentID = 0;
      foreach ($sideDepartmentHeaders as $sideHeader) {
        echo "<strong class='all-side-row'>$sideHeader</strong><br >";
        foreach ($sideDepartment[$sideHeader] as $sideDepartmentID => $sideDepartmentItem) {
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
  let mainSide = document.querySelector(".main-side");
  
  // Directly define the JavaScript object
  let allSideSubDepartments = {
    "Digital Content & Devices": {
      0: {
        "Stream Music": [
          "Amazon Music Unlimited",
          "Free Streaming Music",
          "Podcasts",
          "Open Web Player",
          "Download the app"
        ]
      },
      1: {
        "Kindle E-readers": [
          "Kindle Kids",
          "Kindle",
          "Kindle Paperwhite Kids",
          "Kindle Paperwhite",
          "Kindle Scribe",
          "Accessories",
          "See all Kindle E-Readers"
        ],
        "Kindle Store": [
          "Kindle Books",
          "Kindle Unlimited",
          "Prime Reading",
          "Kindle Vella"
        ],
        "Apps & Resources": [
          "Free Kindle Reading Apps",
          "Kindle for Web",
          "Manage Your Content and Devices",
          "Trade-In"
        ]
      },
      2: {
        "Amazon Appstore": [
          "All Apps and Games",
          "Games",
          "Amazon Coins",
          "Download Amazon Appstore",
          "Amazon Apps",
          "Your Apps and Subscriptions"
        ]
      }
    }
  };

  function fetchSubDepartmentData(departmentHeader, departmentID) {
    subSide.innerHTML = "";
    if(allSideSubDepartments[departmentHeader] && allSideSubDepartments[departmentHeader][departmentID]) {
      let currentSubDep = allSideSubDepartments[departmentHeader][departmentID];
      let subDepartmentTemplate = document.createElement('template');
      let subDepartmentHeaderTemplate = document.createElement('template');
      subDepartmentTemplate.innerHTML = `
      <div class="all-side-row">
        <p class="sideSubDepartments"></p>
        <div> <!-- Just needed --> </div>
      </div>`;

      subDepartmentHeaderTemplate.innerHTML = `
      <div class="all-side-row">
        <strong class="sideSubDepartments"></strong>
        <div> <!-- Just needed --> </div>
      </div>
      <br>`;
      for (const subDepHeader in currentSubDep) {
        const currentSubDepSec = currentSubDep[subDepHeader];
        let headerTemplateCopy = subDepartmentHeaderTemplate.content.cloneNode(true);
        headerTemplateCopy.querySelector('.sideSubDepartments').textContent = subDepHeader;
        subSide.appendChild(headerTemplateCopy);

        for (let i = 0; i < currentSubDepSec.length; i++) {
          const subDepartmentName = currentSubDepSec[i];
          let templateCopy = subDepartmentTemplate.content.cloneNode(true);
          templateCopy.querySelector('.sideSubDepartments').textContent = subDepartmentName;
          subSide.appendChild(templateCopy);
        }
        subSide.appendChild(document.createElement("hr"));
      }
      subDepartmentSwipe();
    }
  }

  let scrollSide = document.querySelector(".scroll-side");
  let backArrow = document.querySelector(".all-side-back-arrow");
  let cancelBtn = document.querySelector(".all-side-cancel-btn");
  function subDepartmentSwipe(){
    mainSide.setAttribute("dontdisplay", "yes");
    console.log("subDepartmentSwipe");
    scrollSide.scrollTo({
      top: 0,
      left: 350,
      behavior: "smooth"
    });
    backArrow.setAttribute("isTransparent", "no");
    cancelBtn.setAttribute("isTransparent", "yes");
  }
  function scrollToMain(){
    console.log("scrollToMain");
    mainSide.setAttribute("dontdisplay", "no");
    scrollSide.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
    backArrow.setAttribute("isTransparent", "yes");
    cancelBtn.setAttribute("isTransparent", "no");
  }
  window.onbeforeunload = function () {
    scrollSide.scrollTo(0, 0);
  }
</script>

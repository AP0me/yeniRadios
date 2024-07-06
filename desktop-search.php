<div class="header-form site-search" style="justify-content: end; width: calc(100% - 30px)">
  <form action="#" class="search-form" role="search" method="get" id="searchform" style="">
    <div class="input-group" style="">
      <div class="input-search-addon" class="searchbar-dropdown">
        <select class="form-select custom-width dynamic-width-select" onchange="adjustSelectWidth(this);" name="product_cat" id="categories">
          <option class="select-value" value="" selected="selected">All Departments</option>
          <option value="apple">Apple</option>
          <option value="camera-photo">Camera &amp; Photo</option>
          <option value="cell-phones">Cell Phones</option>
          <option value="computers-accessories">Computers &amp; Accessories</option>
          <option value="headphones">Headphones</option>
          <option value="smartwatches">Smartwatches</option>
          <option value="sports-outdoors">Sports &amp; Outdoors</option>
          <option value="television-video">Television &amp; Video</option>
          <option value="video-games">Video Games</option>
        </select>
      </div><!-- input-search-addon" -->
      <div class="input-search-field" style = "width: calc(100% - 197px)"><i class="klbth-icon-search"></i><input type="search" value=""
          class="form-control" name="s" placeholder="Search your favorite product..." autocomplete="off"></div>
      <!-- input-search-field -->
      <div class="input-search-button"><button class="btn btn-primary" type="submit">Search</button></div>
      <!-- input-search-button -->
    </div><!-- input-group --><input type="hidden" name="post_type" value="product" />
  </form>
</div>
<script>
  function adjustSelectWidth(selectElement) {
    const testElement = document.createElement('span');
    testElement.style.visibility = 'hidden';
    testElement.style.position = 'absolute';
    testElement.style.whiteSpace = 'nowrap';
    document.body.appendChild(testElement);
    testElement.innerText = selectElement.options[selectElement.selectedIndex].text;
    const selectContainer = selectElement.parentNode;
    const newWidth = testElement.offsetWidth + 29;
    selectContainer.style.width = `${newWidth}px`;
    document.body.removeChild(testElement);
  }
  const selectElement = document.querySelector('.dynamic-width-select');
  adjustSelectWidth(selectElement);
</script>
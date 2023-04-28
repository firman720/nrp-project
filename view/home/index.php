<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Last Data</h6>

    <?php
      for ($i=0; $i < 5; $i++) {


    ?>
    <!-- list -->
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
        role="img" aria-label="Placeholder: 32x32"
        preserveAspectRatio="xMidYMid slice"
        focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#007bff"></rect>
        <text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
     </svg>

      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark">Full Name</strong>
          <a href="#">View</a>
        </div>
        <span class="d-block">@username</span>
      </div>
    </div>
    <!-- end list -->
  <?php } ?>
    <small class="d-block text-end mt-3">
      <a href="#">All Data</a>
    </small>
  </div>

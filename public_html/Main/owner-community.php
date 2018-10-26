<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="tenants-tab" data-toggle="tab" href="#tenants" role="tab" aria-controls="tenants" aria-selected="true">Tenants</a>
    <a class="nav-item nav-link" id="bookings-tab" data-toggle="tab" href="#bookings" role="tab" aria-controls="bookings" aria-selected="false">Bookings</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="tenants" role="tabpanel" aria-labelledby="tenants-tab"><?php include './owner-view-tenants.php'; ?></div>
  <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab"><?php include './owner-view-bookings.php'; ?></div>  
</div>
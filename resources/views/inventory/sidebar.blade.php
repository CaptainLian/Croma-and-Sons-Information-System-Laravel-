<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li>
        <a @if($active == 'dashboard') class="active" @endif href="/inventory/dashboard">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a @if($active === 'SalesOrder' ) class="active" @endif href="/inventory/ApproveSalesOrder">
          <i class="fa fa-file-text"></i>
          <span>Approve Sales Order</span>
        </a>
      </li>
      <li>
        <a @if($active == 'InventoryList') class="active" @endif href="/inventory/InventoryList">
          <i class="fa fa-file-text"></i>
          <span>Inventory List</span>
        </a>
      </li>
      <li>
        <a @if($active == 'EditInvetory') class="active" @endif href="/inventory/EditInventory">
          <i class="fa fa-file"></i>
          <span>Edit Inventory</span>
        </a>
      </li>
      <li>
        <a @if($active == 'InventoryResize') class="active" @endif href="/inventory/InventoryResizeInitial">
          <i class="fa fa-file"></i>
          <span>Inventory Resize</span>
        </a>
      </li>
      <!--multi level menu start-->
      <!-- sidebar menu end-->
    </ul>
  </div>
</aside>

 
   <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li>
        <a @if ($active == 'home')class="active" @endif href="/sales/home">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a @if ($active == 'sof')class="active" @endif href="/sales/salesOrder">
          <i class="fa fa-file-text"></i>
          <span>Create Sales Order</span>
        </a>
      </li>

      <li>
        <a  @if ($active == 'sdri')class="active" @endif href="/sales/deliveryReceiptInitial">
          <i class="fa fa-file-text"></i>
          <span> Create Delivery Receipt</span>
        </a>
      </li>


      <li>
        <a  @if ($active == 'si')class="active" @endif  href="/sales/invoice">
          <i class="fa fa-file-text"></i>
          <span>Create Invoice</span>
        </a>
      </li>


      <li>
        <a  @if ($active == 'sc')class="active" @endif  href="/sales/catalog">
          <i class="fa fa-file-text"></i>
          <span>Sales Catalog</span>
        </a>
      </li>

      <li>
      <a  @if ($active == 'cl')class="active" @endif href="/sales/customerlist">
          <i class="fa fa-file-text"></i>
          <span>Customer List</span>
        </a>
      </li>

      <li>
        <a  @if ($active == 'sr')class="active" @endif  href="/sales/report">
          <i class="fa fa-file"></i>
          <span>Sales Report</span>
        </a>
      </li>


       

      <!--multi level menu start-->

      <!-- sidebar menu end-->
    </div>
 
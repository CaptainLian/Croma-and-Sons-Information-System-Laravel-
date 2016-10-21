 
   <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li>
        <a @if ($active == 'home')class="active" @endif href="/home">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a @if ($active == 'sof')class="active" @endif href="/csof">
          <i class="fa fa-file-text"></i>
          <span>Create Sales Order</span>
        </a>
      </li>

      <li>
        <a  @if ($active == 'sdri')class="active" @endif href="/sdri">
          <i class="fa fa-file-text"></i>
          <span>Create Delivery Receipt</span>
        </a>
      </li>


      <li>
        <a  @if ($active == 'si')class="active" @endif  href="/si">
          <i class="fa fa-file-text"></i>
          <span>Create Invoice</span>
        </a>
      </li>


      <li>
        <a  @if ($active == 'sc')class="active" @endif  href="/sc">
          <i class="fa fa-file-text"></i>
          <span>Sales Catalog</span>
        </a>
      </li>

      <li>
      <a  @if ($active == 'cl')class="active" @endif href="/cl">
          <i class="fa fa-file-text"></i>
          <span>Customer List</span>
        </a>
      </li>

      <li>
        <a  @if ($active == 'sr')class="active" @endif  href="/sr">
          <i class="fa fa-file"></i>
          <span>Sales Report</span>
        </a>
      </li>


      <li>
        <a  @if ($active == 'psr')class="active" @endif href="/psr">
          <i class="fa fa-file"></i>
          <span>Product Sale Report</span>
        </a>
      </li>


      <!--multi level menu start-->

      <!-- sidebar menu end-->
    </div>
 
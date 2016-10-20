<li>
<a @if($active === 'dashboard') class="active" @endif href="ProcurementDashboard.html">
      <i class="fa fa-dashboard"></i>
      <span>Dashboard</span>
  </a>
</li>
<li>
<a @if($active === 'create_purchase_order') class="active" @endif href="ProcurementPurchaseOrder.html">
      <i class="fa fa-file-text"></i>
      <span>Create Purchase Order</span>
  </a>
</li>
<li>
<a @if($active === 'create_delivery_receipt') class="active" @endif href="ProcurementDeliveryReceiptInitial.html">
      <i class="fa fa-file-text"></i>
      <span>Encode Supplier Delivery Receipt</span>
  </a>
</li>
<li>
<a @if($active === 'purchase_List') class="active" @endif href="ProcurementPurchaseList.html">
      <i class="fa fa-file-text"></i>
      <span>Purchase List</span>
  </a>
</li>
<li>
<a @if($active === 'supplier_List') class="active" @endif href="ProcurementSupplierList.html">
      <i class="fa fa-file-text"></i>
      <span>Supplier List</span>
  </a>
</li>
<li>
<a @if($active === 'purchase_report') class="active" @endif href="ProcurementPurchaseReport.html">
      <i class="fa fa-file"></i>
      <span>Purchase Report</span>
  </a>
</li>
<li>
<a @if($active === 'product_purchase_report') class="active" @endif href="ProcurementProductPurchaseReport.html">
      <i class="fa fa-file-text"></i>
      <span>Product Purchase Report</span>
  </a>
</li>	
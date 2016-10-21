<li>
	<a @if($active == 'Dashboard') class="active" @endif href="\procurement\dashboard">
	<i class="fa fa-dashboard"></i>
	<span>Dashboard</span>
	</a>
</li>
<li>
	<a @if($active == 'PurchaseOrder') class="active" @endif href="\procurement\PurchaseOrder">
	<i class="fa fa-file-text"></i>
	<span>Create Purchase Order</span>
	</a>
</li>
<li>
	<a @if($active == 'DeliveryReceipt') class="active" @endif href="ProcurementDeliveryReceiptInitial.html">
	<i class="fa fa-file-text"></i>
	<span>Encode Supplier Delivery Receipt</span>
	</a>
</li>
<li>
	<a @if($active == 'PurchaseList') class="active" @endif href="ProcurementPurchaseList.html">
	<i class="fa fa-file-text"></i>
	<span>Purchase List</span>
	</a>
</li>
<li>
	<a @if($active == 'SupplierList') class="active"@endif href="ProcurementSupplierList.html">
	<i class="fa fa-file-text"></i>
	<span>Supplier List</span>
	</a>
</li>
<li>
	<a @if($active == 'PurchaseReport') class="active" @endif href="ProcurementPurchaseReport.html">
	<i class="fa fa-file"></i>
	<span>Purchase Report</span>
	</a>
</li>
<li>
	<a @if($active == 'ProductPurchaseReport') class="active" @endif href="ProcurementProductPurchaseReport.html">
	<i class="fa fa-file-text"></i>
	<span>Product Purchase Report</span>
	</a>
</li>


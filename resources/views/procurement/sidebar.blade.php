<li>
	<a @if($active == 'Dashboard') class="active" @endif href="\procurement\dashboard">
		<i class="fa fa-dashboard"></i>
		<span>Dashboard</span>
	</a>
</li>
<li>
	<a @if($active == 'PurchaseOrder') class="active" @endif href="\procurement\CreatePurchaseOrder">
		<i class="fa fa-file-text"></i>
		<span>Create Purchase Order</span>
	</a>
</li>
<li>
	<a @if($active == 'DeliveryReceipt') class="active" @endif href="\procurement\DeliveryReceipt">
		<i class="fa fa-file-text"></i>
		Encode Supplier Delivery Receipt
	</a>
</li>
<li>
	<a @if($active == 'PurchaseList') class="active" @endif href="\procurement\PurchaseList">
		<i class="fa fa-file-text"></i>
		<span>Purchase List</span>
	</a>
</li>
<li>
	<a @if($active == 'SupplierList') class="active"@endif href="\procurement\SupplierList">
		<i class="fa fa-file-text"></i>
		<span>Supplier List</span>
	</a>
</li>
<li>
	<a @if($active == 'PurchaseReport') class="active" @endif href="\procurement\PurchaseReport">
		<i class="fa fa-file"></i>
		<span>Purchase Report</span>
	</a>
</li>
<li>
	<a @if($active == 'ProductPurchaseReport') class="active" @endif href="\procurement\ProductPurchaseReport">
		<i class="fa fa-file-text"></i>
		<span><font size="2.2%">Product Purchase Report</font></span>
	</a>
</li>


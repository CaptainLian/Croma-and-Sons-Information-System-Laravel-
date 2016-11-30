/*
$(".aguy").click(function(){
  /*
  $(this).closest("tr").children().each(function(){
    console.log($(this).html());
  });



  var x = $(this).closest("tr").find("td.AguyInput").find("input").val();
  console.log(x);

});
*/
const FAILED = 0;
const SUCCESS = 1;

var quantity = 0;
var selectedRow = null;
$(".RequestButton").click(function(){
  selectedRow = $(this).closest('tr');
  let thisCell = selectedRow.find('td.ProcureRequestCell');

  let quantityInput = thisCell.find('input.RequestAmount');
  quantity = quantityInput.val();

  if((parseFloat(quantity) == parseInt(quantity)) && !isNaN(quantity)){
      if(quantity > 0){

        quantity = parseInt(quantity);

        let modalMaterial = $('#modalMaterial');
        let modalSize = $('#modalSize');
        let modalCurrentQuantity = $('#modalCurrentQuantity');
        let modalQuantityRequested = $('#modalQuantityRequested');
        let modalReorderPoint = $('#modalReorderPoint');
        let modalRequestQuantity = $('#modalRequestQuantity');

        modalMaterial.html(selectedRow.find('td.MaterialCell').html());
        modalSize.html(selectedRow.find('td.SizeCell').html());
        modalCurrentQuantity.html(selectedRow.find('td.StockQuantityCell').html());
        modalQuantityRequested.html(selectedRow.find('td.RequestedQuantityCell').html());
        modalReorderPoint.html(selectedRow.find('td.ReorderPointCell').html());
        modalRequestQuantity.html(quantity);

        $('#ProcurementModal').modal('show');
        quantityInput.removeClass('has-error');
      }else{
        quantityInput.removeClass('has-error');
        quantityInput.addClass('has-error');
      }
  }
});

$('#ProcurementConfirmation').click(function(){
  let thisCell = selectedRow.find('td.ProcureRequestCell');

  let selectedWoodTypeID = thisCell.find('input.WoodTypeID').val();
  let selectedThickness = thisCell.find('input.Thickness').val();
  let selectedWidth = thisCell.find('input.Width').val();
  let selectedLength = thisCell.find('input.Length').val();

  let token = $('meta[name="csrf-token"]').attr('content');

  console.log('AGUY AGUY AGUY');
  console.log('Quantity: ' + quantity);
  console.log('WoodType: ' + selectedWoodTypeID);
  console.log('Thickness: ' + selectedThickness);
  console.log('Width: ' + selectedWidth);
  console.log('Length: ' + selectedLength);

  console.log('Sending AJAX request');

  $.ajax({
    url: '/inventory/ajax/ProcurementRequest',
    type: 'GET',
    data: {
      format: 'json',
      '_token': token,
      'woodTypeID': selectedWoodTypeID,
      'thickness': selectedThickness,
      'width': selectedWidth,
      'length': selectedLength,
      'quantity': quantity
    },
    dataType: 'text',
    success: function(data){
      if(parseInt(data) == SUCCESS ){
        let quantityDisplay = selectedRow.find('td.RequestedQuantityCell');
        let displayedQuantity = parseInt(quantityDisplay.html());

        let newQuantity = parseInt(quantity) + displayedQuantity;
        quantityDisplay.html(newQuantity);

        let alert = $('#alert');
        alert.removeClass('alert alert-success');
        alert.removeClass('alert alert-danger');

        alert.html('Success! Product request successfully filed.');
        alert.addClass('alert alert-success');
      }else{

        let alert = $('#alert');
        alert.removeClass('alert alert alert alert-success');
        alert.removeClass('alert alert alert-danger');

        alert.html('Failed! Internal server error occured.');
        alert.addClass('alert alert-danger');
      }
    },
    error: function(jqXHR, textStatus, errorThrown){
      let alert = $('#alert');
      alert.removeClass('alert alert alert alert-success');
      alert.removeClass('alert alert alert-danger');

      alert.html('Failed! ' + errorThrown);
      alert.addClass('alert alert-danger');

    }

  });
    console.log('AJAX Completed');
});

$(document).ready(function(){
  let subtotal = 0.0;

  $('input.Total').closest('tbody').children().each(function(index, element){
    let row = $(this);
    let receivedQuantity = parseInt(row.find('input.InputQuantityReceived').val());
    let rejectedQuantity = parseInt(row.find('input.InputQuantityRejected').val());
    let unitPrice = parseFloat(row.find('td.UnitPrice').text());

    let total = (receivedQuantity - rejectedQuantity)*unitPrice;
    row.find('input.Total').val(total);

    subtotal += total;
  });


  $('#subtotal').html(subtotal);
  let discountValue = parseFloat($('#inputDiscount').val())/100.0;
  $('#grandTotal').html(subtotal*(1 - discountValue));

});

$(document.body).on('change', '.InputQuantityReceived', function(){
  let row = $(this).closest('tr')
  row.find('input.InputQuantityRejected').attr('max', $(this).val());
  calculate(row);
});

$(document.body).on('change', '.InputQuantityRejected', function(){
  let row = $(this).closest('tr')
  calculate(row);
});

$('#inputDiscount').on('change', function(){
  let subtotalValue = parseFloat($('#subtotal').html());
  let discountValue = parseFloat($('#inputDiscount').val())/100.0;
  $('#grandTotal').html(subtotalValue*(1 - discountValue));
});

function calculate(row){
  let receivedQuantity = parseInt(row.find('input.InputQuantityReceived').val());
  let rejectedQuantity = parseInt(row.find('input.InputQuantityRejected').val());
  let unitPrice = parseFloat(row.find('td.UnitPrice').text());

  let total = (receivedQuantity - rejectedQuantity)*unitPrice;
  row.find('input.Total').val(total);

  let subtotalField = $('#subtotal');
  let grandTotalField = $('#grandTotal');
  let subtotalValue = 0.0;

  $('input.Total').each(function(index){
    subtotalValue += parseFloat($(this).val());
  });

  let discountValue = parseFloat($('#inputDiscount').val())/100.0;

  subtotalField.html(subtotalValue);
  grandTotalField.html(subtotalValue*(1 - discountValue));
}

$(document).ready(function (){
  let subtotal = 0.0;
  $('input.Amount').closest('tbody').children().each(function(index, element){
    let row = $(this);
    let quantity = parseInt(row.find('input.InputQuantity').val());
    let unitPrice = parseFloat(row.find('input.InputUnitPrice').val());

    let amount = quantity*unitPrice;
    row.find('input.Amount').val(amount);

    subtotal += amount;
  });

  $('#subtotal').html(subtotal);
  let discountValue = parseFloat($('#inputDiscount').val())/100.0;
  $('#grandTotal').html(subtotal*(1 - discountValue));
});

$(document.body).on('change' , '.InputQuantity', function(){
  calculate($(this).closest('tr'));
});

$(document.body).on('change', '.InputUnitPrice', function(){
  calculate($(this).closest('tr'));
});

$('#inputDiscount').on('change', function(){
  let subtotalValue = parseFloat($('#subtotal').html());
  let discountValue = parseFloat($('#inputDiscount').val())/100.0;
  $('#grandTotal').html(subtotalValue*(1 - discountValue));
});

function calculate(row){
  let quantity = parseInt(row.find('input.InputQuantity').val());
  let unitPrice = parseFloat(row.find('input.InputUnitPrice').val());

  let amount = quantity*unitPrice;

  row.find('input.Amount').val(amount);

  let subtotalField = $('#subtotal');
  let grandTotalField = $('#grandTotal');
  let subtotalValue = 0.0;

  $('input.Amount').each(function(index){
    subtotalValue += parseFloat($(this).val());
  });

  let discountValue = parseFloat($('#inputDiscount').val())/100.0;

  subtotalField.html(subtotalValue);
  grandTotalField.html(subtotalValue*(1 - discountValue));
}

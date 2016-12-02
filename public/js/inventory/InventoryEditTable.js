var selectedRow = null;

$('.ButtonEditQuantity').click(function(){
  selectedRow = $(this).closest('tr');

  let material = selectedRow.find('td.MaterialCell').html();
  let size = selectedRow.find('td.SizeCell').html();
  let currentQuantity = selectedRow.find('td.StockQuantityCell').html();

  $('#modalMaterial').html(material);
  $('#modalSize').html(size);
  $('#modalStockQuantity').html(currentQuantity);
});

$('#modalSubmit').click(function(){
  //$('input[name=radioName]:checked', '#myForm').val()
  let quantity = $('#newQuantity').val();
  let reason = $('input[name=reason]:checked', '#modalForm').val();
  let remark = $('#remark').val();

  let token = $('meta[name="csrf-token"]').attr('content');

  let woodTypeID = selectedRow.find('.WoodTypeID').val();
  let thickness = selectedRow.find('.Thickness').val();
  let width = selectedRow.find('.Width').val();
  let length = selectedRow.find('.Length').val();

  $.ajax({
    alertMessage: '',
    alertClass: '',
    url: '/inventory/ajax/EditInventory',
    async: false,
    type: 'GET',
    dataType: 'text',
    data: {
      '_token': token,
      'woodTypeID': woodTypeID,
      'thickness': thickness,
      'width': width,
      'length': length,
      'reasonID': reason,
      'newQuantity': quantity,
      'comments': remark
    },
    success: function(data){
      if(data == 1){
        this.alertMessage = '<strong>Success!</strong> Product successfuly updated!';
        this.alertClass = 'alert alert-success';

        selectedRow.find('td.StockQuantityCell').html(quantity);
      }else{
        this.alertMessage = '<strong>Failed!</strong> An error occured while attempting to update. Please try again.';
        this.alertClass = 'alert alert-danger';
      }
      $('#alert').html("<strong>Success!</strong> Inventory successfuly updated.");

      console.log('received data: ' + data);
    },
    error: function(jqXHR, textStatus, errorThrown){
      this.alertMessage = '<strong>Failed!</strong>&nbsp;' + errorThrown + '&nbsp;.Please Try again.';
      this.alertClass = 'alert alert-danger';
    },
    beforeSend: function(jqXHR, settings){
      console.log('sending ajax');
    },
    complete: function(jqXHR, textStatus){
      let alert = $('#alert');

      alert.removeClass('alert alert-success');
      alert.removeClass('alert alert-danger');

      alert.html(this.alertMessage);
      alert.addClass(this.alertClass);

      console.log('ajax complete');
    }
  });
});

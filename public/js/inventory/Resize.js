/*
* @Author: CaptainLian
* @Date:   2016-12-06 21:16:01
* @Last Modified by:   CaptainLian
* @Last Modified time: 2016-12-07 02:38:23
*/
$(document).ready(function(){
	$('#default').stepy({
	  backLabel: 'Previous',
	  block: true,
	  nextLabel: 'Next',
	  titleClick: false,
	  transition: 'slide',
	  titleTarget: '.stepy-tab',
	  next: function(newIndex){
		   let currentIndex = newIndex - 1;
		   console.log(newIndex);	
		   let goNext = true;

		   if(currentIndex == 1){
			   	$('input[name="ApprovedQuantity"]').each(function (index, element){
			   		let currentElement = $(this);
			   		if(currentElement.val() > currentElement.attr('max')){
			   			goNext = false;

			   			return false;
			   		}
			   	});
		   }

		   return goNext;
	  }
	});
});

$(document).ready(function () {
      var form = $("#wizard-validation-form");
      form.validate({
        errorPlacement: function errorPlacement(error, element) {
          element.after(error);
        }
      });
      form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex) {
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
        },
        onFinishing: function (event, currentIndex) {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex) {
          alert("Submitted!");
        }
      });
 });
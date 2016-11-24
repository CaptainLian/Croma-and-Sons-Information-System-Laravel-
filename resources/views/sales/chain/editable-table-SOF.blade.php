<script>
    var EditableTable = function () {

        return {

        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();

            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);

                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = "<select style='width:100%'   class=\"form-control material columnAdjust9p\" name=\'material[]  \' ><option value=\'1\'>Kiln Dry</option><option value=\'2\'>Sun Dry</option></select>" ;
                jqTds[1].innerHTML = '<input  style="width:100%" type="text" class="form-control thick columnAdjust9p" name="thickness[]" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" style="width:100%" class="form-control wid columnAdjust9p" name="width[]" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" style="width:100%" class="form-control len columnAdjust9p" name="length[]" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<input type="text" style="width:100%" ng-model="q" class="form-control quan columnAdjust9p"  name="qty[]" value="' + aData[4] + '">';
                jqTds[5].innerHTML = '<input type="text" style="width:100%"  ng-model="p" class="form-control columnAdjust9p" disabled="" placeholder=\'pcs\' name="unit[]" value="' + aData[5] + '">';
                jqTds[6].innerHTML = '<input type="text" style="width:100%" class="form-control price columnAdjust9p" disabled=""   name="unitprice[]" value="' + aData[6] + '">';
                jqTds[7].innerHTML = '<input type="text" style="width:100%" class="form-control total2  columnAdjust9p" disabled=""   disabled="" value="' + aData[7] +'">';
                jqTds[8].innerHTML = '<a style="width:100%"  class="delete" href="#">Cancel</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
                oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);

                oTable.fnUpdate('<a class="delete" href="#">Delete</a>', nRow, 8, false);

                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate(jqInputs[4].value, nRow, 4, false);
                oTable.fnUpdate(jqInputs[5].value, nRow, 5, false);
                oTable.fnUpdate(jqInputs[6].value, nRow, 6, false);
                  oTable.fnUpdate(jqInputs[7].value, nRow, 7, false);

                oTable.fnUpdate('<a class="edit" href="#">Delete</a>', nRow, 8, false);
                oTable.fnDraw();
            }

            var oTable = $('#editable-sample').dataTable({
                "fnAdjustColumnSizing" : false,
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],

                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'sWidth': "10%",
                        'aTargets': [0]
                    },{


                        'sWidth': "9%",
                        'aTargets': [1]
                    },{


                        'sWidth': "9%",
                        'aTargets': [2]
                    },{


                        'sWidth': "9%",
                        'aTargets': [3]
                    },{


                        'sWidth': "9%",
                        'aTargets': [4]
                    },{


                        'sWidth': "9%",
                        'aTargets': [5]
                    },{


                        'sWidth': "9%",
                        'aTargets': [6]
                    },{


                        'sWidth': "9%",
                        'aTargets': [7]
                    },{


                        'sWidth': "9%",
                        'aTargets': [8]
                    }


                ]
            });

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#editable-sample_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['', '', '', '','','','','','',
                    '<a class="cancel" data-mode="new" href="#">Cancel</a>'
                    ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                 editRow(oTable, nRow);
                nEditing = nRow;
            });



            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);

               /* alert("Deleted! Do not forget to do some ajax to sync with backend :)");*/

               alert('Order is deleted!');
            });

            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                alert('asd');
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });



            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }

            });


        }

    };

}();
</script>

<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="content-body">
        <section class="card">
            <div class="card-content">
                <div class="card-body">
                    <input type="button" class="btn btn-success" value="Add" data-toggle="modal" data-target="#myModal12">
                    <br>
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered dataTables-example">
                            <thead>
                                <tr>
                                    <th class="nosorting">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Add Data -->
    <div class="modal fade text-left" id="myModal12" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static">
        <form name="form1" method="post" action="{{ url('/AddData')}}" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">Add Data</h4>
                    </div>

                    <div id="alertsuccesseditPrice" class="alert alert-success" style="display:none;">
                    </div>
                    <div id="alertErroreditPrice" class="alert alert-danger" style="display:none;">
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Image</label>
                                
                                <input type="file" name="file12">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Name</label>
                                <input type="text" id="Name1" class="form-control" placeholder="Enter Name" name="Name"
                                    value="">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Email</label>
                                <input type="text" id="Email1" class="form-control" placeholder="Enter Email"
                                    name="Email" value="">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Address</label>
                                <input type="text" id="Address1" class="form-control" placeholder="Enter Price"
                                    name="Address" value="">
                                <div id="prodpriceError1" class="error-msg" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-info">Add</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Update Data -->
    <div class="modal fade text-left" id="edit-product-price" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static">
        <form name="form1" method="post" action="{{ url('/UpdateData')}}" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel20">Update Data</h4>
                    </div>

                    <div id="alertsuccesseditPrice" class="alert alert-success" style="display:none;">
                    </div>
                    <div id="alertErroreditPrice" class="alert alert-danger" style="display:none;">
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <input type="hidden" id="studentId" name="studentId">
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Image</label>
                                <div id="container"></div>
                                <input type="file" name="file">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Name</label>
                                <input type="text" id="Name" class="form-control" placeholder="Enter Name" name="Name"
                                    value="">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Email</label>
                                <input type="text" id="Email" class="form-control" placeholder="Enter Email"
                                    name="Email" value="">
                            </div>
                            <div class="form-group col-md-12 com-sm-12 col-xs-12">
                                <label>Address</label>
                                <input type="text" id="Address" class="form-control" placeholder="Enter Price"
                                    name="Address" value="">
                                <div id="prodpriceError1" class="error-msg" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-info">Update</button>
                    </div>
                </div>

            </div>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://use.fontawesome.com/097ba90421.js"></script>
<script>
var pview1 = "";

$(document).ready(function() {

    pview1 = $('.dataTables-example').DataTable({
        "ajax": {
            url: "{{ url('/GetProductdata')}}",
            type: 'GET',
        },
        "processing": true,
        "serverSide": true,
        "columnDefs": [{
                targets: [0, 5],
                orderable: false
            }
            // , {
            //     "width": "25%",
            //     "targets": 4
            // }, {
            //     "width": "15%",
            //     "targets": 7
            // }],
            // "order": [
            //     [0, "desc"]
        ]
    });
});

function isNumber(evt) {
    console.log(evt)
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode > 46) {
        return false;
    } else if (charCode == 46 && $('#prodprice').val().indexOf('.') >= 0) {
        return false;
    } else if (charCode == 46 && $('#prodpriceupdate').val().indexOf('.') >= 0) {
        return false;
    }
    return true;

}


function editproductPrice(id) {
    $.ajax({
        type: "post",
        data: {
            'id': id
        },
        url: "{{url('/Getdetail')}}",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
          
            var placeholder = '<?php echo url('/storage/app/PlaceHolder/placeholder-image.PNG'); ?>';
            var img = '<?php echo url('/storage/app/product_image'); ?>' + '/' + data.Data.images;
            var logo = data.Data.images;
            $('#Name').val(data.Data.name);
            $('#Address').val(data.Data.address);
            $('#Email').val(data.Data.email);
            $('#studentId').val(data.Data.studentId);
            $('#container').html('<img src="' + (logo == null ? placeholder : img) +
                '"  height="200" width="200"/>');
            $('#edit-product-price').modal('show');
        }
    })
}
</script>

</html>
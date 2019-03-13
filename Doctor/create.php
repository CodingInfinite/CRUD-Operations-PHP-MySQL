<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Doctor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">CNIC</label>
                          <input type="text" class="form-control" id="cnic" placeholder="Enter CNIC">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Address</label>
                          <input type="text" class="form-control" id="address" placeholder="Enter Address">
                        </div>
                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddDoctor()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
?>
<script>
  function AddDoctor(){
        $.ajax(
        {
            type: "POST",
            url: '../api/doctor/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                email: $("#email").val(),				
                password: $("#password").val(),
                phone: $("#phone").val(),
                cnic: $("#cnic").val(),
                address: $("#address").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Doctor!");
                    window.location.href = '/medibed/doctor';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
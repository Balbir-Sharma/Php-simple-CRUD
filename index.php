<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
  <style>
    .table {
      container: centre;
      margin: 30px;
      padding: 30px;
      font-size: 20px;
    }
  </style>

</head>

<body>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add User
  </button>
  
  <h1 id="displaytable"></h1>

  <!-- Button trigger modal -->

  <!--Add user Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="adddata" class="row g-3">
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Name :</label>
              <input type="text" class="form-control" name="uname" id="name">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email: </label>
              <input type="email" class="form-control" name="uemail" id="email">
            </div>
            <div class="col-12">
              <label for="Phone" class="form-label">Phone :</label>
              <input type="number" class="form-control" id="phone" name="uphone">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control" name="uaddress" id="address" placeholder="1234 Main St">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" name="submit" onclick="submitdata()" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!--Edit user Modal -->
  <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="updateForm" class="row g-3">
          <input type="hidden" name="uid" id="updateid">
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Name :</label>
              <input type="text" class="form-control" name="uname" id="updatename">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email: </label>
              <input type="email" class="form-control" name="uemail" id="updateemail">
            </div>
            <div class="col-12">
              <label for="Phone" class="form-label">Phone :</label>
              <input type="number" class="form-control" id="updatephone" name="uphone">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control" name="uaddress" id="updateaddress">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" name="submit" class="user_update btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


  <script>
    $(document).ready(function() {
      displayData();
    });

    // show data
    function displayData() {
      $.ajax({
        url: 'display.php',
        type: 'GET',
        success: function(response) {
          $('#displaytable').html(response);
        }
      });
    }
    // add data
    function submitdata() {
      var username = $('#name').val();
      var useremail = $('#email').val();
      var userphone  = $('#phone').val();
      var useraddress = $('#address').val();

      $.ajax({
        url: 'insert.php',
        type: 'post',
        data: {
          aname: username,
          aemail: useremail,
          aaddress: useraddress,
          aphone: userphone
        },
        success: function(data, status) {
          // console.log(status);
          $('#exampleModal').modal('hide');
          $('#adddata')[0].reset();
          displayData();
        }
      })
    }
    // delete record

    function deleteRecord($id) {
      $.ajax({
        url: 'delete.php',
        type: 'GET',
        data: {
          deleteid: $id,
        },
        success: function(data, status) {
          displayData();
        }
      })
    }

   // update data
$(document).on("click", ".user_edit", function(e) {
  e.preventDefault();
    var id = $(this).data('id');

    $.ajax({
        url: 'update.php',
        type: 'POST',
        data: {
            id: id,
            edit: true
        },
        success: function(result) {
            let response = JSON.parse(result);
            // Populate the update modal with fetched data
            $('#updateid').val(response.id);
            $('#updatename').val(response.name);
            $('#updateemail').val(response.email);
            $('#updatephone').val(response.phone);
            $('#updateaddress').val(response.address);
            // Show the update modal
            $('#editmodal').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
});

$(document).on("click", ".user_update", function(e) {
        e.preventDefault();
        var id = $('#updateid').val();
        var name = $('#updatename').val();
        var email = $('#updateemail').val();
        var phone = $('#updatephone').val();
        var address = $('#updateaddress').val();

        $.ajax({
            url: 'update.php',
            type: 'POST',
            data: {
                id: id,
                name: name,
                email: email,
                phone: phone,
                address: address
            },
            success: function(result) {
                
                $('#editmodal').modal('hide');
             
                displayData();
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
      });
 
  </script>
</body>

</html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h2>List Products</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <table id="productTable"
              class="table table-bordered
                     table-condensed table-striped">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Introduction Date</th>
            <th>URL</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
  <form action="">

    <div class="form-group">
    <label for="exampleInputEmail1">Product name</label>
    <input type="text" class="form-control" id="productname" aria-describedby="emailHelp" placeholder="Enter email">

  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <input type="text" class="form-control" id="introdate" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">URL</label>
    <input type="text" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>



  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>



<button type="button" id="updateButton"
        class="btn btn-primary"
        onclick="productUpdate();">
  Add
</button>
</form>

</div>


</body>
<script>


  function productAddToTable() {
  // Does tbody tag exist ? add one if not
  if ($("#productTable tbody").length == 0) {
    $("#productTable")
      .append("<tbody></tbody>");
  }
  // Append product to table
  $("#productTable tbody").append(
    productBuildTableRow(_nextId));
  // Increment next ID to use
  _nextId += 1;
}

  function productUpdate() {
  if ($("#productname").val() != null &&
      $("#productname").val() != '') {
    // Add product to Table
    productAddToTable();
    // Clear form fields
    formClear();
    // Focus to product name field
    $("#productname").focus();
  }
}

function productBuildTableRow() {
  var ret =
  "<tr>" +
    "<td>" +
      "<button type='button' " +
              "onclick='productDisplay(this);' " +
              "class='btn btn-default'>" +
              "<span class='glyphicon glyphicon-edit' />" +
      "</button>" +
    "</td>" +
    "<td>" + $("#productname").val() + "</td>" +
    "<td>" + $("#introdate").val() + "</td>" +
    "<td>" + $("#url").val() + "</td>" +
    "<td>" +
      "<button type='button' " +
              "onclick='productDelete(this);' " +
              "class='btn btn-default'>" +
              "<span class='glyphicon glyphicon-remove' />" +
      "</button>" +
    "</td>" +
  "</tr>"

  return ret;
}
</script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
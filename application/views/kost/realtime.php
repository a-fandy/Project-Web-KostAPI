<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>realtime example</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/navbar-top.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Realtime example</a>
    </nav>

    <main role="main" class="container">
      <div class="jumbotron">
        <h1>Realtime data kost</h1>
        <p class="lead">just input name kost to view realtime data with ajax (GET/PSOT)</p>
        <p class="lead">other field will be filled with the same data</p>
        <!-- <a class="btn btn-lg btn-primary" href="../../components/navbar/" role="button">View navbar docs &raquo;</a> -->
        <div class="input-group col-4">
          <input id="namekost" type="text" class="form-control" placeholder="name kost" aria-label="Username" aria-describedby="basic-addon1">
          <button id="insert" onclick="insertdata()" type="button" class="btn btn-success">insert</button>
        </div>
      </div>

      <table id="mytable" class="table table-bordered">
        <thead>
          <tr>
              <th scope="col">NamaKost</th>
              <th scope="col">Alamat</th>
              <th scope="col">NoTelp</th>
              <th scope="col">NamaPemilik</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Jenis</th>
              <th scope="col">Harga</th>   
          </tr>
        </thead>
        <tbody>
              <tr>
                 
              </tr>
        </tbody>
      </table>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>assets/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script>window.jQuery || document.write('<script src="http://localhost/KostAPI/application/asset/jquery-slim.min.js"><\/script>')</script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>

  <script>
  var time;
  // var site =<?php echo '"'.base_url().'Kost/481f4b73e27afd9fd9"'?>;
  var site= "https://kostapi.000webhostapp.com/Kost/481f4b73e27afd9fd9";
  $(document).ready(function() {
    selesai();
  });

  function update(){
      $.ajax({
        url: site, //This is the current doc
        type: "GET",
			  dataType: "json",
        success: function(data){
          viewintable(data);
        },
			  error: function () {
					alert("Failed! Please try again.");
          clearTimeout(time);
			  }
      }); 
    }
  
  function viewintable(data){
      var table = document.getElementById("mytable");
      if(table.rows.length-1<data.length){
        del();
        $.each(data, function( index, value ) {
          var row = table.insertRow(index+1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          var cell6 = row.insertCell(5);
          var cell7 = row.insertCell(6);

          cell1.innerHTML = value.namaKost;
          cell2.innerHTML = value.alamat;
          cell3.innerHTML = value.noTelp;
          cell4.innerHTML = value.namaPemilik;
          cell5.innerHTML = value.ukuran;
          cell6.innerHTML = value.jenis;
          cell7.innerHTML = value.harga;
        });
      }
      
    }

  function del(){
    var table = document.getElementById('mytable');
    var i=1;
    while(i<table.rows.length){
      table.deleteRow(i);
    }
  }

  function selesai() {
   time= setTimeout(function() {
      update();
      selesai();
    }, 200);
  }

  function insertdata(){
    var namekost = document.getElementById('namekost').value;
    $.ajax({
        url: site, //This is the current doc
        type: "POST",
        data: {tersedia:3,namaKost:namekost,alamat:'solo',
                noTelp:81234567897,namaPemilik:'Subari',
                ukuran:'2x9',jenis:'pria',harga:65,
                gambar:'id8.jpg',deskripsi:'Tidak ada batasan jam kunjung'},
			  dataType: "json",
        success: function(data){
          console.log(data);
          document.getElementById('namekost').value='';
        },
			  error: function () {
					alert("Failed! Please try again.");
			  }
    });

  }

  deletedata();
  function deletedata(){
    $.ajax({
        url: "https://kostapi.000webhostapp.com/Kost/481f4b73e27afd9fd9", //This is the current doc
        type: "DELETE",
        data: {idKost:"18"},
			  dataType: "json",
        success: function(data){
          console.log(data);
        },
			  error: function () {
					alert("Failed! Please try again.");
			  }
    });

  }
  </script>

</html>

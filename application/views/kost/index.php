<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="<?php echo base_url();?>assets/cover.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Daftar Kost</title>
</head>

<body class="text-center">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">API KOST</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <!-- <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a> -->
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 class="cover-heading">Golek Kost</h1>
    <p class="lead"> GET / POST: <a href="<?php echo base_url();?>Kost/481f4b73e27afd9fd9"> <?php echo base_url();?>Kost/481f4b73e27afd9fd9 </a> </p>
    <p>Parameter</p>
    <p>Get : null / idKost</p>
    <p>Post:tersedia,namaKost,alamat,noTelp,namaPemilik,ukuran,jenis,harga,gambar,deskripsi</p>
    <p class="lead">
      <a href="http://golekkost.000webhostapp.com/" class="btn btn-lg btn-secondary">Golek Kost</a>
    </p>
  </main>

  <table id="tableeditable" class="table table-bordered">
  <thead>
    <tr>
        <th scope="col">NamaKost</th>
        <th scope="col">Alamat</th>
        <th scope="col">NoTelp</th>
        <th scope="col">NamaPemilik</th>
        <th scope="col">Ukuran</th>
        <th scope="col">Harga</th>  
        <th scope="col">Action</th>   
    </tr>
  </thead>
  <tbody id="tbod">
    <?php 
      $i=0;
        foreach($kost as $k){
             ?>
        <tr id="tab<?php echo $i; ?>" name="tab[]">
            <td><input name="namaKost[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->namaKost; ?>" disabled></td>
            <td><input name="alamat[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->alamat; ?>" disabled></td>
            <td><input name="noTelp[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->noTelp; ?>" disabled></td>
            <td><input name="namaPemilik[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->namaPemilik; ?>" disabled></td>
            <td><input name="ukuran[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->ukuran; ?>" disabled></td>
            <td><input name="harga[]" class="form-control" style="background-color:black;border:none;color:white" type="text" value="<?php echo $k->harga; ?>" disabled></td>
            <td>
              <a name="save[]" onclick='save(<?php echo $i;?>)' hidden><i class="fa fa-save"></i></a>
							<a name="cancel[]"  onclick='cancel(<?php echo $i;?>)' hidden><i class="fa fa-times"></i></a>
							<a name="edit[]"  onclick='edit(<?php echo $i;?>)'><i class="fa fa-pencil"></i></a>
							<a name="del[]"  onclick='del(<?php echo $i;?>)'><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php 
      $i++;
      } ?>
  </tbody>
</table>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>API Server by Fandy</p>
    </div>
  </footer>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="http://localhost/KostAPI/application/asset/jquery-slim.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
 
 
  var size=document.getElementsByName("tab[]").length;
  var namaKost=[size],alamat=[size],noTelp=[size],namaPemilik=[size],ukuran=[size],harga=[size];
  var nodes = Array.prototype.slice.call( document.getElementById('tbod').children );
 
  
  
    

  function edit(d){
    var i = nodes.indexOf( document.getElementById("tab"+d));
    document.getElementsByName("cancel[]")[i].removeAttribute("hidden");
    document.getElementsByName("save[]")[i].removeAttribute("hidden");
    document.getElementsByName("edit[]")[i].setAttribute("hidden",true);
    document.getElementsByName("del[]")[i].setAttribute("hidden",true);
    salin(i);
    setAtt("style","",i);
    reAtt("disabled",i);
  }
  function save(d){
    var i = nodes.indexOf( document.getElementById("tab"+d));
    document.getElementsByName("cancel[]")[i].setAttribute("hidden",true);
    document.getElementsByName("save[]")[i].setAttribute("hidden",true);
    document.getElementsByName("edit[]")[i].removeAttribute("hidden");
    document.getElementsByName("del[]")[i].removeAttribute("hidden");

    setAtt("disabled",true,i);
    setAtt("style","background-color:black;border:none;color:white",i);
  }

  function cancel(d){
    var i = nodes.indexOf( document.getElementById("tab"+d));
    document.getElementsByName("cancel[]")[i].setAttribute("hidden",true);
    document.getElementsByName("save[]")[i].setAttribute("hidden",true);
    document.getElementsByName("edit[]")[i].removeAttribute("hidden");
    document.getElementsByName("del[]")[i].removeAttribute("hidden");

    setAtt("disabled",true,i);
    setAtt("style","background-color:black;border:none;color:white",i);
    salin2(i);
  }

  function del(d){
    var i = nodes.indexOf( document.getElementById("tab"+d));
    console.log(i);
    document.getElementById('tbod').deleteRow(i);
    nodes = Array.prototype.slice.call( document.getElementById('tbod').children );
    size=document.getElementsByName("tab[]").length;
  }





  function salin(i){
    namaKost[i] = document.getElementsByName("namaKost[]")[i].value;
    alamat[i] = document.getElementsByName("alamat[]")[i].value;
    noTelp[i] = document.getElementsByName("noTelp[]")[i].value;
    namaPemilik[i] = document.getElementsByName("namaPemilik[]")[i].value;
    ukuran[i] = document.getElementsByName("ukuran[]")[i].value;
    harga[i]= document.getElementsByName("harga[]")[i].value;
  }

  function salin2(i){
   document.getElementsByName("namaKost[]")[i].value = namaKost[i] ;
   document.getElementsByName("alamat[]")[i].value =alamat[i];
   document.getElementsByName("noTelp[]")[i].value = noTelp[i];
   document.getElementsByName("namaPemilik[]")[i].value = namaPemilik[i];
   document.getElementsByName("ukuran[]")[i].value = ukuran[i];
   document.getElementsByName("harga[]")[i].value = harga[i];
  }

  function setAtt(atr,val,i){
    document.getElementsByName("namaKost[]")[i].setAttribute(atr,val);
    document.getElementsByName("alamat[]")[i].setAttribute(atr,val);
    document.getElementsByName("noTelp[]")[i].setAttribute(atr,val);
    document.getElementsByName("namaPemilik[]")[i].setAttribute(atr,val);
    document.getElementsByName("ukuran[]")[i].setAttribute(atr,val);
    document.getElementsByName("harga[]")[i].setAttribute(atr,val);
  }

  function reAtt(atr,i){
    document.getElementsByName("namaKost[]")[i].removeAttribute(atr);
    document.getElementsByName("alamat[]")[i].removeAttribute(atr);
    document.getElementsByName("noTelp[]")[i].removeAttribute(atr);
    document.getElementsByName("namaPemilik[]")[i].removeAttribute(atr);
    document.getElementsByName("ukuran[]")[i].removeAttribute(atr);
    document.getElementsByName("harga[]")[i].removeAttribute(atr);
  }


</script>

</body>
</html>
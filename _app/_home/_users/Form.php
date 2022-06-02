  
<div class="content-page">
 <div class="content">
  <div class="container-fluid">
   <div class="row">
    <div class="col-12">
     <div class="page-title-box">
      <div class="page-title-right">
       <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">SIPT POS </a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </div>
    <h4 class="page-title">Users</h4>
  </div>
</div>
</div> 


<div class="row">
 <div class="col-12">
  <div class="card">
   <div class="card-body">
    <h4 class="header-title">Form Users</h4>
    <form id="Form"  enctype="multipart/form-data" method="POST">
     <div class="form-row">
      <div class="form-group col-md-6">
       <label for="inputEmail4" class="col-form-label">Nama Pengguna</label>
       <input type="text" class="form-control" id="inputnama" name="inputnama" placeholder="Nama Pengguna" required/>
     </div>
     <div class="form-group col-md-3">
       <label for="inputPassword4" class="col-form-label">Kode Login</label>
       <input type="text" class="form-control" id="inputkodelogin" name="inputkodelogin" value="<?=rand(1000,9999);?>" readonly/>
     </div>
     <div class="form-group col-md-3">
       <label for="inputAddress" class="col-form-label">Password</label>
       <input type="text" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required="">
     </div>
   </div>
   <div class="form-row">
    <div class="form-group col-md-3">
     <label for="inputAddress" class="col-form-label">Tanggal Lahir</label>
     <input type="date" class="form-control" name="datetanggal" id="datetanggal" placeholder="Password Nya" required="">
   </div>

   <div class="form-group col-3">
     <label for="inputAddress2" class="col-form-label">Tempat Lahir</label>
     <input type="text" class="form-control" id="texttempat" name="texttempat" placeholder="Tempat Lahir" required="">
   </div>
   <div class="form-group col-md-6">
     <label for="inputState" class="col-form-label">Level</label>
     <select id="optionLevel" name="optionLevel" class="form-control" required="">
      <option>Pilih</option>
      <?php 
      $Level = mysqli_query($conn,"select * from level where nama_level !='admin' order by id_level");
      while($DataLevel = mysqli_fetch_array($Level)){
       echo'
       <option value='.$DataLevel['id_level'].'>'.$DataLevel['nama_level'].'</option>';
     }?>
   </select>
 </div>
</div>
<div class="form-row">
  <div class="col-lg-4">
   <label for="inputState" class="col-form-label">Nomor Telphone</label>
   <input type="text" maxlength="12" id="textnomor" class="form-control" name="textnomor"  />
 </div>

 <div class="col-lg-4">
   <label for="inputState" class="col-form-label">Foto</label>
   <input type="file" id="foto" class="form-control" name="foto"  />
 </div>
</div>
<br>
<button type="submit" id="PostData" class="btn btn-primary waves-effect waves-light">Save</button>
<a href="?Halaman=_users">
 <button type="button" id="PostData" class="btn btn-info waves-effect waves-light">Back</button>
</a>
</form>

</div> <!-- end card-body -->
</div> <!-- end card-->
</div> <!-- end col -->
</div>
</div>
</div>
<script>
  $("#Form").on('submit',(function(e) {
   e.preventDefault();
   $.ajax({
    url: '_users/_proses.php?Kirim',
    type: "POST",
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    dataType: "JSON",
    success: function (respone) {
     if (respone.status == 'success') {
      swal.fire({
       title: respone.status,
       text: respone.message,
       icon: respone.status
     }).then(function(){ 
       location.reload(true);
     }
     );
   } else{
     swal.fire({
      title: respone.status,
      text: respone.message,
      icon: respone.status
    }).then(function(){ 
     
    }
    );
  }
}
});
 }));

</script>
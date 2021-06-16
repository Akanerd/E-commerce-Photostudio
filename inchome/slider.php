<?php
// $slider = "SELECT id,judul,deskripsi,gambar FROM carousel ORDER BY id ASC";
// $result = mysqli_query($konek, $slider);
$query ="SELECT * FROM tb_slide ORDER BY urutan ASC";
$result = $konek->query($query);?>

<!-- slider -->
<div class="section">
  <div class="container">
    <div class="row">

      <div class=" col-md-4 ">
        <div class="photo">
          <div class="photo-img">
            <img src="./img/slider.png" alt="" width="340px" height="200px">
          </div>
        </div>
        <div class="photo">
          <div class="photo-img">
            <img src="./img/slider2.png" alt="" width="340px" height="200px">
          </div>
        </div>
      </div>
      <div class=" col-md-8 ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
     <?php
        for($i=0; $i<$result->num_rows;$i++){
            echo '
            <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"';
            if($i==0){echo'class="active"';}echo'></li>';
        }?>
      </ol>
      <div class="carousel-inner">
          <?php
          if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
            if($row['urutan'] == 1){
              echo'<div class="carousel-item active">';}else{echo'<div class="carousel-item">';}
              echo'
                <img src="img/slider/'.$row['gambar'].'" class="d-block w-100" alt="..." width="1080px" height="425px ">
                <div class="carousel-caption d-none d-md-block">
                <h5 style="color:white">'.$row['judul_slide'].'</h5>
                    <p>'.$row['keterangan'].'</p>
                </div>  
              </div>';
          }}?>
 
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
      </div>
    </div>
  </div>
</div>
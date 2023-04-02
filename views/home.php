<?php

   $title = "Dentiste:Home Page" ;
   ob_start();
?>
<div class="landing">
      <div class="content row">
        <div class="text col-12">
          <h1>Achieve Desired Perfect Smile</h1>
          <p>Far far away,behind the word moutains,far from the countries </p>
          <div class="row">
            <a class="col-lg-5 col-sm-12 btn btn-lang  me-lg-2 me-md-2 px-3 py-2 mb-sm-1 mb-lg-0">SEE OUR SERVICES</a>
            <a href="index.php?action=appoint" class="col-lg-6 col-sm-12 btn btn-lang px-3 py-2 ">BOOK AN APPOINTMENT</a>
          </div>
        </div> 
      </div>
</div>

<div class="about">
    <h2 class="main-heading px-3 py-1 text-align-center">ABOUT US</h2>
    <div class="container">
    </div>
    
</div>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 

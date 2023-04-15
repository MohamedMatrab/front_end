<?php

   $title = "Dentiste:Appointment Page" ;
   ob_start();
?>
<link rel="stylesheet" href="style/style.css" >
<div class="landing-page">
    <h2 class="main-header">Contact</h2>
</div>
<section id="contact" class="contact">
      <div class="container">

        <div class="section-title mt-5">
          <p> contactez nous pour plus d'informations</p>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <div><i class="bi bi-geo-alt"></i></div>
                 
                 <div class="text-contact">
                 <h4>Location:</h4>
                 <p>Eddahbi,Gueliz marrakech</p>
                 </div>
                
              </div>

              <div class="email">
                <div><i class="bi bi-envelope"></i></div>
                
                <div class="text-contact">
                <h4>Email:</h4>
                <p><a href="mailto:esthétique@gmail.com">esthétique@gmail.com</a><p>
                </div>
                
              </div>

              <div class="phone">
                <div><i class="bi bi-phone"></i></div>
                <div class="text-contact">
                <h4>Call:</h4>
                <p><a href="tel:+212 693452015">+212 693452015</a><p>
                </div>
    
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3396.979999113054!2d-8.016004!3d31.634398!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafee8c16aaf64b%3A0x908a00581b0d2694!2sCentre%20dentaire%20Moqadem%20Haf%C3%A7a%20(Hollywood%20smile%2C%20Implant%2C%20proth%C3%A8se%2C%20Facettes%2C%20P%C3%A9dodontie%2C%20Blanchiment)%20Maroc%2C%20Marrakech!5e0!3m2!1sfr!2sma!4v1677161821153!5m2!1sfr!2sma" width="330" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

          </div>
        </div>

        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="contact.php" method="POST" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Your Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" name="email" id="email" required >
              </div>
            </div>
            
            <div class="form-group mt-3">
              <label for="message">Message</label>
              <textarea class="form-control" name="message" rows="10" id="message" required ></textarea>
            </div>
              
            
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->


<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 
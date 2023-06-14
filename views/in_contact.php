<section id="contact" class="contact">
  <div class="container">
    <div class="row">

      <div class="col-lg-5 d-flex align-items-stretch">
        <div class="info">
          <div class="address">
            <div><i class="bi bi-geo-alt"></i></div>

            <div class="text-contact">
              <h4>Location:</h4>
              <p><?php echo isset($coord['address']) ? $coord['address'] : '?'; ?></p>
            </div>

          </div>

          <div class="email">
            <div><i class="bi bi-envelope"></i></div>

            <div class="text-contact">
              <h4>Email:</h4>
              <p><a href="mailto:<?php echo isset($coord['email']) ? $coord['email'] : '?'; ?>"><?php echo isset($coord['email']) ? $coord['email'] : '?'; ?></a>
              <p>
            </div>

          </div>

          <div class="phone">
            <div><i class="bi bi-phone"></i></div>
            <div class="text-contact">
              <h4>Call:</h4>
              <p><a href="tel:<?php echo isset($coord['numero_1']) ? $coord['numero_1'] : '?'; ?>"><?php echo isset($coord['numero_1']) ? $coord['numero_1'] : '?'; ?></a>
              <p>
            </div>

          </div>

          <iframe src="<?php echo isset($coord['localisation']) ? $coord['localisation'] : 'http://localhost/front_end/index.php?action=contact'; ?>" width="330" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

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
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
          </div>

          <div class="form-group mt-3">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" rows="10" id="message" required></textarea>
          </div>


          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
      </div>

    </div>

  </div>
</section><!-- End Contact Section -->

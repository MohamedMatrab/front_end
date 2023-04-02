<?php

   $title = "Dentiste:Centre Page" ;
   ob_start();
?>
<div class="landing-page">
    <h2 class="main-header">Doctor</h2>
</div>
<div class="About">
    <div class="container">
      <h1>Bienvenue dans l’univers auquel on crée la sourire.</h1>
      <h3>Votre sourire est la première chose que les gens remarquent, il est l’expression de votre bien être, vous ne pouvez l’exprimer pleinement que si vous êtes à l’aise avec.</h3>
    </div>
</div>

<?php $content = ob_get_clean() ; ?>
<?php include_once 'views/layout.php' ; ?> 


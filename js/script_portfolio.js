$(document).ready(function () {
  //show all pictures at first
  let service_id = "all";
  //function to get pictures from databse and add it to .galerie-group
  function getPics() {
    $.ajax({
      type: "POST",
      url: "Models/portfolio_pics.php",
      data: {
        service_id,
      },
      dataType: "json",
      success: function (response) {
        let images = response["images"];
        if (images.length > 0) {
          for (let image of images) {
            //div image section
            let img_sec = document.createElement("div");
            img_sec.classList.add("image-section");
            //image
            let img = new Image();
            img.src = image["src"];
            //a element
            let a = document.createElement("a");
            a.href = "index.php?action=service&id="+image['service_id'];
            let desc_img = document.createElement("div");
            desc_img.classList.add("description-image");
            //span in desc-image
            let span = document.createElement("span");
            span.textContent = image["title"];
            desc_img.append(span);
            a.append(desc_img);
            img_sec.append(img);
            img_sec.append(a);

            $(".galerie-group").append(img_sec);
          }
        } else {
          url = window.location.href;
          url = url.replace("?action=portfolio", "");
          let p =
            '<div class="text-center alert alert-info w-50 h-50" style="margin-top:2rem;">Pas d\'images pour ce service ! Vous Pouvez <a href="' +
            url +
            '" class="alert-link">Revenir à la page d\'accueil </a>.</div>';
          document.querySelector(".galerie-group").innerHTML = p;
        }
      },
    });
  }
  //for first load
  getPics();
  $("#select-services").value = service_id;
  $("#select-services").change(function (e) {
    e.preventDefault();
    //On Change
    $(".galerie-group").empty();
    service_id = $(this).val();
    getPics();
  });
});

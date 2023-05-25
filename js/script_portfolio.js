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
        for (let image of images) {
          //div image section 
          let img_sec = document.createElement('div');
          img_sec.classList.add('image-section');
          //image
          let img = new Image();
          img.src=image['src'];
          //a element
          let a=document.createElement('a');
          a.href="#";
          let desc_img = document.createElement('div');
          desc_img.classList.add('description-image');
          //span in desc-image
          let span =document.createElement('span');
          span.textContent=image['title'];
          desc_img.append(span);
          a.append(desc_img);
          img_sec.append(img);
          img_sec.append(a);
          
          $(".galerie-group").append(img_sec);
        }
      },
    });
  }
  //for first load
  getPics();
  $("#select-services").change(function (e) {
    e.preventDefault();
    //On Change
    $(".galerie-group").empty();
    service_id = $(this).val();
    getPics();
  });
});
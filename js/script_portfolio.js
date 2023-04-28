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
          $(".galerie-group").append(image);
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

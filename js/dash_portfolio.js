const selectServices = document.getElementById("select-services");
const add_image = document.getElementById("add_image");
console.log("portfolio");

let service_id = "";
if (sessionStorage.selectVal != null) {
  selectServices.value = sessionStorage.selectVal;
} else {
  sessionStorage.selectVal = selectServices.value;
}
service_id = selectServices.value;

$(document).ready(function () {
  //initialization
  let image_id;
  function delHandler() {
    if (
      window.confirm("Est ce que vous voulez vraiment supprimer cette image ?")
    ) {
      $.ajax({
        type: "POST",
        url: "Models/delete_image.php",
        data: {
          image_id,
        },
        dataType: "json",
        success: function (response) {
          success = response.success;
          if (success) {
            sessionStorage.selectVal = selectServices.value;
            window.location.reload();
          }
        },
      });
    }
  }
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
          let img_sec = document.createElement("div");
          img_sec.classList.add("image-section");
          img_sec.value = image["id"];
          //image
          let img = new Image();
          img.src = image["src"];
          //edit element
          let edit = document.createElement("div");
          edit.classList.add("edit");
          let icon = document.createElement("i");
          icon.classList.add("bi");
          icon.classList.add("bi-pencil-square");
          edit.append(icon);
          edit.addEventListener("click", () => {
            window.location.href =
              "dashboard.php?action=edit_image&id=" + image["id"];
          });
          //delete icon
          let del = document.createElement("div");
          del.classList.add("del");
          del.addEventListener("click", () => {
            image_id = image["id"];
            delHandler();
          });
          let icon_d = document.createElement("i");
          icon_d.classList.add("bi");
          icon_d.classList.add("bi-trash");
          del.append(icon_d);

          img_sec.append(img);
          img_sec.append(edit, del);

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
    sessionStorage.selectVal = service_id;
    getPics();
  });
});

add_image.addEventListener("click", () => {
  window.location.href = "dashboard.php?action=add_image";
});

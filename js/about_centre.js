$(document).ready(function () {
  $(".add_photo a").click(function () {
    let div_add = document.createElement("div");
    div_add.className = "ajout_photo";
    let form = document.createElement("form");
    form.action = "Models/edit_delete_centre.php" ;
    form.method = "POST";
    form.enctype = "multipart/form-data" ;
    div_add.appendChild(form);
    let label = document.createElement("label");
    label.htmlFor = "my_image";
    label.innerHTML = "Select Image";
    let input = document.createElement("input");
    input.type = "file";
    input.className = "form-control mt-4";
    input.name = "my_image";
    let submit = document.createElement("input");
    submit.type = "submit";
    submit.name ="submit" ;
    submit.className ="btn btn-primary";
    submit.value = "Add Image";
    form.appendChild(label);
    form.appendChild(input);
    div_add.appendChild(submit);
    let container = document.querySelector(".dashboard-content");
    
    window.scroll(container.offsetTop , 0) ;
    container.insertAdjacentElement("beforebegin", div_add);
    var container_up = document.querySelector(".dashboard-content");
    container_up.classList.add("blur");
    

    submit.addEventListener("click" , ()=>{
        form.submit();
    })


    });

    $(".del_centre").click(function() {
        var del = document.querySelector(".del_centre") ;
        var attribute = del.getAttribute('data-id');
        // var attribute = $(this).getAttribute('data-id') ;
        window.location = "Models/edit_delete_centre.php?id_photo="+attribute;
    })
});

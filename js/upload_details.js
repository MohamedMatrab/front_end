$(document).ready(function () {
  function getdetailsPatient() {
    console.log(CIN);
    $.ajax({
      type: "POST",
      url: "Models/getDetailsPatient.php",
      data: {
        id: CIN
      },
      dataType: "json",
      success: function (response) {
        let patient = response["patient"];
        console.log(patient);
        let name_pt = document.querySelector("#file .head .name_pt");

        name_pt.innerHTML = "Dossier médical de " + patient["name"];

        let info = [
          patient["name"],
          patient["tel"],
          patient["address"],
          patient["date_Birth"]
        ];
        let div_info = document.querySelectorAll("#file form .row .rflex p");
        for (let i = 1; i < div_info.length; i++) {
          div_info[i].innerHTML = info[i - 1];
        }

        let formData = document.querySelector("#file .info_pt form .row ");
        let form = document.querySelector("#more_details");
        if (patient["poids"] == 0 && patient["taille"] == 0) {
          let content = `<div class="rflex"> 
                                <h3 class="fs-5">taille :</h3> 
                                <p class="fs-5"><input class="form-control" type="text" name="taille"></p>
                            </div>
                            <div class="rflex">
                                <h3 class="fs-5">poids :</h3>
                                <p class="fs-5"><input class="form-control" type="text" name="poids"></p>
                            </div>`;
          formData.insertAdjacentHTML("beforeend", content);
        } else {
          let content =
            `<div class="rflex">
                                <h3 class="fs-5">taille :</h3> 
                                <p class="fs-5">` +
            patient["taille"] +
            `</p>
                            </div>
                            <div class="rflex">
                                <h3 class="fs-5">poids :</h3>
                                <p class="fs-5">` +
            patient["poids"] +
            `</p>
                            </div>`;
          formData.insertAdjacentHTML("beforeend", content);
        }
        document.addEventListener("keydown", (e) => {
          if (e.key === "Enter") {
            form.submit();
          }
        });
        $.ajax({
          type: "POST",
          url: "Models/getDetailsAppointment.php",
          data: {
            id: CIN
          },
          dataType: "json",
          success: function (response) {
            let appoint = response["appointment"];
            let Details = [];
            let dates = [];
            appoint.forEach((el, index) => {
              let contentRdv = document.querySelector(".content div");
              let detailsDiv = document.createElement("div");
              detailsDiv.className = "details";
              contentRdv.appendChild(detailsDiv);
              let date = document.createElement("div");
              date.classList.add(...["date", "inactive", "mt-2"]);
              date.innerHTML = el["date_rendez"];
              detailsDiv.appendChild(date);
              Details.push(detailsDiv);
              dates.push(date);
              if (dates.length === appoint.length) {
                dates.forEach((date, index) => {
                  date.addEventListener("click", (e) => {
                    dates.forEach((el) => {
                      if (el !== e.target && el.classList.contains("active")) {
                        el.classList.remove("active");
                        el.classList.add("inactive");
                        let appointDiv =
                          document.querySelector(".info_appoint");
                        appointDiv.remove();
                      }
                    });
                    if (e.target.classList.contains("active")) {
                      e.target.classList.remove("active");
                      e.target.classList.add("inactive");
                      let appointDiv = document.querySelector(".info_appoint");
                      appointDiv.remove();
                    } else {
                      e.target.classList.remove("inactive");
                      e.target.classList.add("active");
                      $.ajax({
                        type: "POST",
                        url: "Models/getOrdonnance.php",
                        data: {
                          Data: JSON.stringify({
                            id: CIN,
                            date: e.target.innerHTML
                          })
                        },
                        dataType: "json",
                        success: function (response) {
                          let ordonnace = response["msg"];
                          let info_appoint = document.createElement("div");
                          info_appoint.classList.add(...["info_appoint"]);
                          Details[index].appendChild(info_appoint);

                          let about_appoint = document.createElement("div");
                          about_appoint.classList.add(...["aboout_appoint"]);
                          info_appoint.appendChild(about_appoint);

                          // box specialites
                          let boxSpecialites = document.createElement("div");
                          boxSpecialites.classList.add(...["box"]);
                          about_appoint.appendChild(boxSpecialites);

                          let sh3 = document.createElement("h3");
                          sh3.className = "fs-5";
                          sh3.innerHTML = "spécialité";
                          boxSpecialites.appendChild(sh3);

                          let sp = document.createElement("p");
                          sp.className = "fs-5";
                          sp.innerHTML = el["service"];
                          boxSpecialites.appendChild(sp);

                          // box specialites
                          $.ajax({
                            type: "POST",
                            url: "Models/getDetailsDoctor.php",
                            data: {
                              service_id: el["service_id"]
                            },
                            dataType: "json",
                            success: function (response) {
                              let doctor = response["doctor"];
                              console.log(doctor);
                              // box specialites
                              let boxDoctor = document.createElement("div");
                              boxDoctor.classList.add(...["box"]);
                              about_appoint.appendChild(boxDoctor);

                              let dh3 = document.createElement("h3");
                              dh3.className = "fs-5";
                              dh3.innerHTML = "doctor";
                              boxDoctor.appendChild(dh3);

                              let dp = document.createElement("p");
                              dp.className = "fs-5";
                              dp.innerHTML =
                                doctor["Nom"] + " " + doctor["Prenom"];
                              boxDoctor.appendChild(dp);

                              // box ordonnace
                              let boxOrdonnance = document.createElement("div");
                              boxOrdonnance.classList.add(...["box"]);
                              about_appoint.appendChild(boxOrdonnance);

                              let oh3 = document.createElement("h3");
                              oh3.className = "fs-5";
                              oh3.innerHTML = "ordonnance";
                              boxOrdonnance.appendChild(oh3);

                              if (ordonnace === null) {
                                let image = document.createElement("div");
                                image.classList.add(...["image"]);
                                about_appoint.appendChild(image);

                                let ajout_image = document.createElement("div");
                                ajout_image.className = "ajout_image";
                                image.appendChild(ajout_image);

                                let content = document.createElement("div");
                                content.classList.add(...["content"]);
                                ajout_image.appendChild(content);

                                let label = document.createElement("label");
                                label.htmlFor = "ordonnance" + index;
                                content.appendChild(label);

                                let form = document.createElement("form");
                                form.method = "POST";
                                form.enctype = "multipart/form-data";
                                form.action =
                                  "Models/upload_ordonnance.php?ID=" +
                                  CIN +
                                  "&&date=" +
                                  e.target.innerHTML;
                                label.appendChild(form);

                                let input = document.createElement("input");
                                input.type = "file";
                                input.id = "ordonnance" + index;
                                input.className = "sr-only";
                                input.name = "ordonnance";
                                form.appendChild(input);

                                let i = document.createElement("i");
                                i.className =
                                  "bi bi-file-earmark-arrow-up fs-2";
                                label.appendChild(i);
                                let p = document.createElement("p");
                                p.innerHTML = "charger l'ordonnance";
                                label.appendChild(p);

                                let button = document.createElement("button");
                                button.innerHTML = "Envoyer";
                                info_appoint.appendChild(button);

                                input.addEventListener("change", (e) => {
                                  if (document.querySelector(".imageOrdo")) {
                                    document
                                      .querySelector(".imageOrdo")
                                      .remove();
                                  }
                                  let file = e.target.files[0];
                                  let name = file.name;
                                  let imageOrdo = document.createElement("div");
                                  imageOrdo.className = "imageOrdo";
                                  ajout_image.appendChild(imageOrdo);
                                  let img = document.createElement("img");
                                  img.src = "OrdonnaceImage/" + name;
                                  imageOrdo.appendChild(img);
                                  content.classList.add("hidden");
                                  if (document.querySelector(".lab-annuler")) {
                                    document
                                      .querySelector(".lab-annuler")
                                      .remove();
                                  }
                                  let label_ann =
                                    document.createElement("label");
                                  label_ann.className = "lab-annuler";
                                  label_ann.htmlFor = "ordonnance" + index;
                                  info_appoint.appendChild(label_ann);
                                  let annu = document.createElement("a");
                                  annu.innerHTML = "modifier";
                                  annu.className = "btn btn-danger";
                                  label_ann.appendChild(annu);
                                });
                                button.addEventListener("click", (e) => {
                                  form.submit();
                                });
                              } else {
                                let image = document.createElement("div");
                                image.classList.add(...["image"]);
                                about_appoint.appendChild(image);

                                let ajout_image = document.createElement("div");
                                ajout_image.className = "ajout_image";
                                image.appendChild(ajout_image);
                                let imageOrdonnance =
                                  document.createElement("div");
                                imageOrdonnance.className = "imageOrdonnance";
                                ajout_image.appendChild(imageOrdonnance);

                                let img = document.createElement("img");

                                img.src = ordonnace["src"];
                                img.alt = "Image Not Found";
                                imageOrdonnance.appendChild(img);
                                let div_icon = document.createElement("div");
                                div_icon.className = "full";
                                div_icon.style.position = "absolute";
                                div_icon.style.right = "11px";
                                div_icon.style.top = "0";
                                div_icon.style.cursor = "pointer";
                                imageOrdonnance.appendChild(div_icon);
                                let icon = document.createElement("i");
                                icon.className = "bi bi-fullscreen";
                                icon.style.fontSize = "2rem";
                                div_icon.appendChild(icon);
                                div_icon.addEventListener("mouseenter", (e) => {
                                  e.target.style.transform = "scale(1.05)";
                                  div.style.display="block";
                                });
                                div_icon.addEventListener(
                                  "mouseleave",
                                  (e) => {
                                    e.target.style.transform =
                                      "none";
                                  }
                                );
                                document.addEventListener(
                                  "fullscreenchange",
                                  function (event) {
                                    if (!document.fullscreenElement) {
                                      // L'image a quitté le mode plein écran
                                      let div_icon =
                                        document.createElement("div");
                                      div_icon.className = "full";
                                      div_icon.style.position = "absolute";
                                      div_icon.style.right = "11px";
                                      div_icon.style.top = "0";
                                      div_icon.style.cursor = "pointer";
                                      imageOrdonnance.appendChild(div_icon);

                                      let icon = document.createElement("i");
                                      icon.className = "bi bi-fullscreen";
                                      icon.style.fontSize = "2rem";
                                      div_icon.appendChild(icon);

                                      div_icon.addEventListener(
                                        "mouseenter",
                                        (e) => {
                                          e.target.style.transform =
                                            "scale(1.05)";
                                        }
                                      );
                                      div_icon.addEventListener(
                                        "mouseleave",
                                        (e) => {
                                          e.target.style.transform =
                                            "none";
                                        }
                                      );
                                      icon.addEventListener("click", () => {
                                        img.requestFullscreen();
                                        icon.remove();
                                      
                                      });
                                    }
                                  }
                                );
                                icon.addEventListener("click", () => {
                                  img.requestFullscreen();
                                  icon.remove();
                                });
                              }
                            }
                          });
                        }
                      });
                    }
                  });
                });
              }
            });
          }
        });
      },
      error: function (xhrs, state, error) {
        console.log(error);
      }
    });
  }
  CIN = $("#file form .row .rflex p").html();
  // console.log(Code);
  getdetailsPatient();
});

let Sections = document.querySelectorAll("section div");
let sidebarSections = document.querySelectorAll(".disabled");
let Dropdown = [["toutes les résérvations","historique"] , ["Users","account"] , ["Portfolio","Servive","Centre"]] ;

for (let i = 0 ; i < sidebarSections.length ; i++) {
    sidebarSections[i].addEventListener("click" ,() => {
            if (sidebarSections[i].classList.contains("disabled")){
                sidebarSections.forEach((el) => {
                    el.classList.remove("active") ;
                    el.classList.add("disabled") ;
                }) 
                Sections.forEach((el) => {
                    el.innerHTML = "" ;
                })
                sidebarSections[i].classList.remove("disabled") ;
                sidebarSections[i].classList.add("active") ;

                const ul = document.createElement("ul");
                ul.className = "drop-down" ;
                Sections[i].appendChild(ul);
                for (let j = 0 ; j < Dropdown[i].length ; j++) {
                const li = document.createElement("li");
                const a = document.createElement("a");
                a.href = "#" ;
                const text = document.createTextNode(Dropdown[i][j]);
                a.appendChild(text);
                li.appendChild(a);
                ul.appendChild(li);
                }
            } else {
                sidebarSections[i].classList.remove("active") ;
                sidebarSections[i].classList.add("disabled") ;
                Sections[i].innerHTML = "" ;
            }





        
    }) ;
}
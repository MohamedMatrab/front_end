let Sections = document.querySelectorAll("section .opt");
let sidebarSections = document.querySelectorAll(".disable");
let Dropdown = [["toutes les résérvations","historique"] , ["Users","account"] , ["Portfolio","Servive","Centre"]] ;
let page = [["index.php?action=dash_appointment","index.php?action=historique"] , 
            ["index.php?action=users","index.php?action=account"] , 
            ["index.php?action=page_portfolio","index.php?action=page_servive","index.php?action=page_centre"]] ;

for (let i = 0 ; i < sidebarSections.length ; i++) {
    sidebarSections[i].addEventListener("click" ,() => {
            if (sidebarSections[i].classList.contains("disable")){
                sidebarSections.forEach((el) => {
                    el.classList.remove("ac-tive") ;
                    el.classList.add("disable") ;
                }) 
                Sections.forEach((el) => {
                    el.innerHTML = "" ;
                })
                sidebarSections[i].classList.remove("disable") ;
                sidebarSections[i].classList.add("ac-tive") ;

                const ul = document.createElement("ul");
                ul.className = "drop-down" ;
                for (let j = 0 ; j < Dropdown[i].length ; j++) {
                    const li = document.createElement("li");
                    li.className = "option" ;
                    const a = document.createElement("a");
                    a.href = page[i][j] ;
                    const text = document.createTextNode(Dropdown[i][j]);
                    a.appendChild(text);
                    li.appendChild(a);
                    ul.appendChild(li);
                    Sections[i].appendChild(ul);
                }
            } else {
                sidebarSections[i].classList.remove("ac-tive") ;
                sidebarSections[i].classList.add("disable") ;
                Sections[i].innerHTML = "" ;
            }





        
    }) ;
}


let btn_valider = document.querySelectorAll(".valider") ;
btn_valider.forEach((el)=> {
    console.log(el);
    el.addEventListener("click" , ()=>{
        el.innerHTML = '';
        el.innerHTML = `<i class="bi bi-check-lg"></i>`;
    });
})


document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); 
        document.getElementById('more_details').submit();
    } 
}) ;

let box_date = document.querySelectorAll("#file .content .date.box");
let info_appoint = document.querySelector("#file .about-appoint");
console.log(box_date);
for (let i = 0 ; i < box_date.length ; i++) {
    box_date[i].addEventListener("onclick", ()=>{
        console.log("1");
        if (e.target.classList.contains("none")) {
            e.target.classList.remove("none") ;
            info_appoint[i].classList.remove("hidde");
            info_appoint[i].classList.add("visible");
        }else {
            e.target.classList.add("none") ;
            info_appoint[i].classList.remove("visible");
            info_appoint[i].classList.add("hidde");
        }
    }) ;
};



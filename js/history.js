let links = document.querySelectorAll(".dossier");

links.forEach((link) => {
    link.addEventListener("click", () => {
        let ID = link.getAttribute("data-id");
        // console.log(ID);
        window.location.href="dashboard.php?action=ulpoad_details&&ID="+ID;
    });
});
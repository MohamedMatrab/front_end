<!-- Not complete !!!!! -->
<?php
if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
?>
    <script>
        let body_container = document.querySelector("html");
        const Html_succes = `
        <div class="succes">
            <div>
                <div class="succes_icons"><i class="bi bi-exclamation-lg"></i></i></div>
                <p><?= $_SESSION['message'] ?></p>
                <br>
                <a href="">Ok</a>
            </div>
        </div>`;

        let container = document.querySelector("body");
        container.classList.add("app_fixe");
        body_container.insertAdjacentHTML("beforeend", Html_succes);
    </script>
<?php
    unset($_SESSION['message']);
}
?>
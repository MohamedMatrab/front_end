<!-- Not complete !!!!! -->
<?php
if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        .succes {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #ddddddf0;
            color: #fff;
            text-align: center;
            z-index: 9999;
            opacity: 1;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            width: 30em;
            max-width: 90%;
            height: 20em;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
        }

        .succes_icons i {
            color: var(--cadetblue-color);
            background-color: white;
            box-shadow: 0px 0px 10px #ddd;
            border-radius: 50%;
            padding: 10px;
            font-size: 2.5em;
            display: flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            margin: 0 auto 1em;
        }

        .succes p,
        .succes h2 {
            color: black;
        }

        .succes a {
            display: block;
            color: white;
            background-color: var(--cadetblue-color);
            border-radius: 6px;
            padding: 0.4em 1em;
            width: fit-content;
            margin: 0 auto;
            font-size: 22px;
            text-transform: uppercase;
        }

        .succes a:hover {
            color: white;
        }

        .app_fixe {
            filter: blur(2px) !important;
            transition: 0.3s ease-in-out !important;
            pointer-events: none !important;
        }

        #floating_ok {
            text-decoration: none !important;
        }
    </style>
    <script>
        let body_container = document.querySelector("html");
        const Html_succes = `
        <div class="succes">
            <div>
                <div class="succes_icons"><i class="bi bi-exclamation-lg"></i></i></div>
                <p><?= $_SESSION['message'] ?></p>
                <br>
                <a id='floating_ok' href="">Ok</a>
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
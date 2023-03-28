<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex1</title>
</head>
<body>
    <h1>Introduction</h1>
    <p>le web est un ensemble d'informations</p>
    <a href="http://www.google.be/">Recherche Google</a>
    <br>
    <a href="http://www.marmiton.org/">Des recettes culinaires</a>
    <br>
    <a href="http://www.louvre.fr/">La musée de louvre</a>
    <br>
    <div>
    <form action="">
        <div>
        <label for="">Prénom</label>
        <input type="text">
        </div>
        <div>
        <label for="">Nom</label>
        <input type="text">
        </div>
        <div>
        <label for="">Civilité</label>
        <input type="text" placeholder="Mme">Madame
        <br>
        <input type="text" placeholder="Mlle">Mademoiselle
        <br>
        <input type="text" placeholder="M">Monsieur
        </div>
        <div>
        <label for="">Email</label>
        <input type="email" name="" id="">
        </div>
        
        <div>
        <label for="">Est ce que vous etes étudiante(e):</label>
        <input type="checkbox" name="" id="">Oui
        <input type="checkbox" name="" id="">Non
        </div>
        <div>
        <label for="">Préférence</label>
        <select name="" id="">
            <option value="">Contactez-moi par emial</option>
        </select>
        </div>
        <div>
            <button type="submit">Ok</button>
            <button>annuler</button>
        </div>
    </form>
    </div>
    <div>
        <h2>tableau</h2>
        <table style="border: 1px solid black ; width:100%;">
            <tbody>
                <tr>
                    <td style="border: 1px solid black">12</td>
                    <td style="border: 1px solid black">13</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">14</td>
                    <td style="border: 1px solid black">15</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">16</td>
                    <td style="border: 1px solid black">17</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">18</td>
                    <td style="border: 1px solid black">19</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">20</td>
                    <td style="border: 1px solid black">21</td>
                </tr>
                <tr>
                    <td  style="border: 1px solid black" align = "center" colspan="2" >22</td>>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Image</h2>
        <img src="../front_end/images/about.jpg" alt="">
        <h2>audio</h2>
        <audio src="" ></audio>
        <h2>vidéo</h2>
        <video src="" loop></video>
    </div>

</body>
</html>
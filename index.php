<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Väderprognos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<!-- Head-element och som är en behållare för metadata. Metadata har används för att definierar dokumentitel, style, teckenuppsättning samt länkar till bootstrap.-->

<body>
    <header>
        <!--Elementet header representerar loggan och bootsrap ikonen.-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <!--Ett nav-element som kräver en wrapping .navbar och .navbar-expand{-sm|-md|-lg|-xl} för responsiva kollaps. Navbar-dark och bg-dark används för att definiera färgschemat. -->
            <a class="navbar-brand" href="http://localhost:8080/V%c3%a4derApp/">
                <!--Klassen navbar-brand används för loggan och företagetsnamnet. Har en vis teckenstorlek, färg, margin och padding-->
                Väderprognos
            </a>
            <i class='fas fa-cloud-sun' style='font-size:24px; color: white;'></i>
            <!--Koden har tagits från https://www.w3schools.com/icons/fontawesome5_icons_objects.asp och det är ikon moln-->

        </nav>
    </header>

    <main>

        <div class="imgbild">
            <!--En klass som ger 40 px i margin bottom-->

            <img src="bilder/img1.jpg" style="max-height: 30em; width: 100%;" alt="en bild">
            <!--En jpg-bild som är från https://pixabay.com/sv/ -->

        </div>

        <div class="container">
            <!--Klassen container är en grundläggande layotelement i bootstrap och krävs när man använder standard grid system. En fast beddbehållare har används, vilket innebär att maxbredden ändras vid varje brytpunkt-->
            <br />
            <div class="row justify-content-center;" style="margin-bottom:60px;" id="search">
                <!--Egenskapen justify-content används för att definiera vart innehållet ska placeras och i detta fall mitten.    -->
                <div class="col-12">
                    <!--12 col är 100% width -->
                    <form method="post" class="card card-sm" id="submitref">
                        <!-- Klassen card är en flexibel och utdragbar innehållsbehållare. Den innehåller bland annat kontextuella bakgrundsfärger och kraftfulla visningsalternativ. Card-sm är en responsiv klass som är för små enheter (Skärmbredd som är lika eller större än 576px). -->
                        <div class="card-body row no-gutters align-items-center">
                            <!-- Klassen card-body andvänds för att få en padded section inom ett kort, no-gutters för att ta bort mellanrum samt align-items-center för att centrerar inriktningarna för alla objekt i det elementet  -->
                            <div class="col-auto" style="margin-right: 10px;">

                                <i class="fas fa-search h4 text-body"></i>
                                <!--Koden har tagits från https://www.w3schools.com/icons/fontawesome5_icons_objects.asp och är en search ikon -->
                            </div>
                            <div class="col">
                                <input name="inputValue" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Ange stad" id="inputvalue">
                                <!--Formkontrollerna får en automatisk global styling med bootstrap. Alla textual element som till exempel <input>, <textarea> och <select> med klass .form-control har en bredd på 100%.  -->
                            </div>
                            <div class="col-auto" style="margin:6px;">.
                                <button name="button1" class="btn btn-lg btn-success" type="submit">Search</button>
                                <!-- btn-klasserna är designade för att användas till knapp-element. btn-success ger en grön bakgrundsfärg på knappen-->
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <?php
        include("fetch.php"); // Inkluderar filen "fetch.php" för ytterligare funktionaliter, 
        ?>

    </main>

</body>


</html>
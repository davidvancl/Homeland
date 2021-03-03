<!doctype html>
<html lang="cs">
    <head>
        <title>Grand Theft Auto V</title>

        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html">
        <meta name="author" content="David Vancl">
        <meta http-equiv="Content-language" content="cs">
        <meta name="keywords" content="GTA, GTA 5, GTA V,grand theft auto, grand theft auto 5, grand theft auto V">
        <meta name="description" content="Stránka s informacemi a historií hry GTA 5.">.
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="icon" href="Images/icon.ico" type="image/ico" sizes="16x16">
        <link rel="stylesheet" href="Styles/main_style.css">
    </head>
    <body>
        <header id="header">
            <img id="headerLogo" src="Images/header_logo.png" alt="Grand Theft Auto V">
            <h1 id="headerTitle" class="GTAFont">Grand Theft Auto</h1>
            <nav id="main_nav">
                <hgroup>
                    <a href="#" class="navHref"><h2 class="GTAFont navItem">Historie</h2></a>
                    <a href="#" class="navHref"><h2 class="GTAFont navItem">Informace</h2></a>
                    <a href="#" class="navHref"><h2 class="GTAFont navItem">Recenze</h2></a>
                    <a href="#" class="navHref"><h2 class="GTAFont navItem">Kontakt</h2></a>
                </hgroup>
            </nav>
            <img id="menuIcon" src="Images/menu_icon.png" alt="Menu" onclick="changeMenuVisibility()">
        </header>

        <nav id="sub_nav" style="height: 0">
            <hgroup>
                <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Historie</h2></a>
                <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Informace</h2></a><br>
                <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Recenze</h2></a><br>
                <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Kontakt</h2></a><br>
            </hgroup>
        </nav>

        <section id="slider">
            <figure>
                <img src="Images/Slider/1.jpg" alt="">
                <img src="Images/Slider/2.jpg" alt="">
                <img src="Images/Slider/3.jpg" alt="">
                <img src="Images/Slider/4.jpg" alt="">
                <img src="Images/Slider/1.jpg" alt="">
            </figure>
            <img id="sliderLogo" src="Images/Slider/LogoSlider.svg" alt="">
        </section>
        
        <main>
            <article> Vlastní text článku.
                <section>První <em>kapitola</em>, <strong>třeba</strong> i s podnadpisy</section>
                    <section>Druhá kapitola nebo jakkoli odlišný obsah</section>
            <aside>Sloupeček, který ale ještě patří do článku</aside>
        </main>
        <nav>spodní navigace</nav>
        <aside>reklama</aside>



<!--        <footer>patička</footer>-->

        <script>
            function changeMenuVisibility(){
                if(document.getElementById("sub_nav").style.height === "0px"){
                    document.getElementById("sub_nav").style.height = "270px";
                } else {
                    document.getElementById("sub_nav").style.height = "0px";
                }
            }
        </script>
    </body>
</html>
<!doctype html>
<html lang="cs">
    <head>
        <title>Kontakty</title>
        <meta charset="UTF-8">
        <meta name="author" content="David Vancl">
        <meta name="keywords" content="GTA, GTA 5, GTA V,grand theft auto, grand theft auto 5, grand theft auto V, contact, kontakt, formulář">
        <meta name="description" content="Kontaktní formulář">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../Images/icon.ico" type="image/ico" sizes="16x16">
        <link rel="stylesheet" href="../Styles/header_footer_background.css">
        <link rel="stylesheet" href="../Styles/contact_style.css">
    </head>
    <body onload="preloadTable()">
        <header id="header">
            <img id="headerLogo" src="../Images/header_logo.png" alt="Grand Theft Auto V">
            <h1 id="headerTitle" class="GTAFont">Kontakty</h1>
            <nav id="main_nav">
                <a href="history.html" class="navHref"><h2 class="GTAFont navItem">Historie</h2></a>
                <a href="#" class="navHref"><h2 class="GTAFont navItem">Recenze</h2></a>
                <a href="../index.html" class="navHref"><h2 class="GTAFont navItem">Úvod</h2></a>
                <a href="#" class="navHref"><h2 class="GTAFont navItem">Informace</h2></a>
            </nav>
            <img id="menuIcon" src="../Images/menu_icon.png" alt="Menu" onclick="changeMenuVisibility()">
        </header>

        <nav id="sub_nav" style="height: 0">
            <a href="history.html" class="navHref"><h2 class="GTAFont navItem navSuvItem">Historie</h2></a><br>
            <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Recenze</h2></a><br>
            <a href="../index.html" class="navHref"><h2 class="GTAFont navItem navSuvItem">Úvod</h2></a>
            <a href="#" class="navHref"><h2 class="GTAFont navItem navSuvItem">Informace</h2></a><br>
        </nav>

        <section id="formBody">
            <h3 class="GTAFont" id="sectionTitle"><a href="#dataForm">kontaktní údaje</a> / <br id="rem"><a href="#contactForm">kontaktní formulář</a></h3>
            <form id="dataForm">
                <fieldset id="dataSection">
                    <legend>kontaktní údaje</legend>
                    <article id="articleData">
                        <ul style="text-align: left">
                            <li class="infoIcon"><abbr title="Majitel firmy">Daniel Mikuláš</abbr></li>
                            <li>
                                <ul>
                                    <li class="telIcon">777 888 999</li>
                                    <li class="emailIcon">daniel.mikulas@gta.com</li>
                                </ul>
                            </li>
                            <li class="infoIcon"><abbr title="Hlavní vývojář">Pavel Chodník</abbr></li>
                            <li>
                                <ul>
                                    <li class="telIcon">555 555 555</li>
                                    <li class="emailIcon">pavel.chodnik@gta.com</li>
                                </ul>
                            </li>
                            <li class="infoIcon"><abbr title="Sekretářka">Jana Jupiter</abbr></li>
                            <li>
                                <ul>
                                    <li class="telIcon">123 456 789</li>
                                    <li class="emailIcon">jana.jupiter@gta.com</li>
                                </ul>
                            </li>
                        </ul>
                    </article>
                </fieldset>
            </form>
            <form method="post" action="#" name="contactForm" id="contactForm">
                <fieldset id="fieldContact">
                    <legend>kontaktní formulář</legend>
                    <label for="name">Jméno</label>
                    <input name="name" id="name"  maxlength="30" autocomplete="off" placeholder="Karel" required>
                    <label for="surname">Přijmení</label>
                    <input type="text" name="surname" id="surname"  maxlength="30" autocomplete="off" placeholder="Vomáčka" required>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email"  autocomplete="off" placeholder="kare.vomacka@gmail.com" required>
                    <label for="gender">Pohlaví</label>
                    <select name="gender" id="gender" required>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <label for="phone">Telefon</label>
                    <input type="tel" name="phone" id="phone"  autocomplete="off" placeholder="778 998 887" required>
                    <label for="message">Zpráva</label>
                    <textarea name="message" id="message"  autocomplete="off" required></textarea>
                    <button type="submit" name="send" id="send">Odeslat</button>
                </fieldset>
            </form>
        </section>

        <footer>
            <p id="author_title" class="GTAFont">David Vancl</p>
            <p class="css_validator">
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Ověřit CSS!" />
                </a>
            </p>
        </footer>

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
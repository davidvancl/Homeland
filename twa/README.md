# Grand Theft Auto V - TWA (Body obsažené v semestrálním projektu)
#### Požadavky na HTML:
- [X] Oddělené záhlaví, zápatí menu a obsah, vytvořené pomocí sémantických elementů HTML5.
- Každá stránka obsahuje **záklaví** *(nadpis stránky)*, **navigační menu**, **tělo**, **zápatí** *(odkazy a citace)*
- [X] Menu vytvořené pomocí seznamu s příslušným stylem.
- Pro desktop je menu v **záhlaví** stránky, pro mobily jse pod **záhlavím** *(seznam je využit bez dekorativních doplňků)*
- [X] Odstavce a nadpisy 1 - 3 úrovně.
- Nadpisy jsou využívány dle důležitosti **H1 - H4** po celém projektu
- [X] Číslovaný a nečíslovaný seznam *(každý minimálně celkem 7 položek ve dvou úrovních)*.
- **číslovaný** seznam na stránce [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html) jako navigační panel u obrázků a videí
- **nečíslovaný** seznam na stránce [Kontakty](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/contact.html) jako zobrazení pracovníků *(upravené dekorace)*
- [X] Odkazy z textu obsahu a odkazy na fragment stránky.
- odkazy na **fragmenty** stánky jsou na stránce [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html) v podobě navigačního panelu
- odkazy na **jiné stránky** jsou př. na [Úvod](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) u článků jako *přečtěte si více*
- [X] Minimálně 3 obrázky jako součást hlavního obsahu stránky.
- obrázky jsou na [Úvodní](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) stránce v promítání, nebo v [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html)
- [X] Tabulku s popiskem a záhlavím, využívající spojování buněk v horizontálním i vertikálním směru.
- tabulka je dostupná na stránce [Historie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/history.html) *(slévání sloupečků a řádků proběhne v ránci JS, kvůli responsivitě na mobilní zařízení)*
- [X] Formulář obsahující minimálně 3 viditelné elementy, využívající fieldset, legend a label.
- na stránce [Kontakty](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/contact.html), formulář zpracovávající inforace a ulkádá je do DB
- [X] Syntakticky vyznačené zvýraznění a zkratky (em, strong, abbr).
- doplňky textu jsou na [Úvodní stránce](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) v jednotlivých článkách, *(abbr - na [Kontakty](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/contact.html) jako zvýraznění pozice zaměstnance)*

---

#### Požadavky na CSS:
- [X] Barva písma a pozadí.
- každá stránka má rozdílné pozadí pro **desktop** a pro **mobily** *(každé specificky upravené pro dané rozlišení)*
- barva písma *(skoro každý prvek, kde je text)*
- [X] Font a velikost písma.
- úprava **nadpisů**, **podnadpisů** a veškerého **textu** ve stránce
- [X] Nastavení chování odkazů *(navštívený, aktivní, ...)*
- příkladem je **navigační panel** na stránce [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html), odkazy se mění barevně podle navštívenosti
- [X] Nadpisy.
- lze najít kdekoliv kde je *(article, section, header, ... )*
- [X] Responzivní chování stránky ve dvou úrovních.
- stránka je vytvořena tak, aby byla funkční na **všech zařízeních** *(někde víc, někde míň)*, ale neměla by se nikdy rozbít *(kolize textu, obrazku, overflow, ...)*
- [X] Flexibilní rozložení obsahu v závislosti na rozlišení.
- většina obsahu je navžena tak, aby při určité šířce se nastavil **display: block**, pouze vzácně se využívá statických pozic, většina jsou **%**
- [X] Responzivní menu.
- pro **desktop** je menu v **header**, pro uživatele jednodušší
- na **mobilu** je pod **header** aby nemuselo být zbytečně malé a nenarušovalo header panel, tak je pod header připojen s možností rozkliku
- všechny soubory se styly lze nálézt [zde](https://github.com/davidvancl/Homeland/tree/master/twa/Styles)

---

#### Rozšiřující úkoly:
- [X] HTML5 média (audio, video, figure).
- všechny alementy se nachází na stránce [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html), další figure je promítání na [Úvodní](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) stránce
- [X] HTML5 formuláře (nové atributy a typy).
- kompletní formulář s elementy na stránce [Kontakty](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/contact.html)
- klientská vlidace je separovaná v **.js** souboru, validace serverová je v souboru **.php**
- po zvalidování na serveru je kontaktní form uložen do **DB**
- [X] Alternativní barevné schéma a rozložení CSS.
- jakákoliv stránka
- [X] CSS pro tiskový výstup (skrytí navigace).
- stránka [Galerie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/gallery.html) navigační panel je skryt, na **:hover** je rozbalen
- [X] Pokročilé funkce CSS (generování obsahu).
- na stránce [Historie](https://github.com/davidvancl/Homeland/blob/master/twa/Pages/history.html) při zmenšení tabulky pro mobily se vygenerují popisky pro jednotlivé řádky
- [X] Rozšířené vlastnosti z CSS3 (animace, přechodové efekty, transformace, nové vlastnosti, vlastní fonty).
- animace je třeba v [Úvodní stránce](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) promítání obrázků
- přechodové efekty využity př. **nav panel** na každé stránce
- celý web je ve **fontu** použitý v GTA
- [X] Pokročilá responzivita CSS (širší škála podporovaných rozlišení, responzivní média).
- podpora pro 'snad všechna rozlišení'
- [X] Využití vloženého SVG v HTML nebo CSS
- SVG je **ikonka** *(logo)* v [Úvodnu](https://github.com/davidvancl/Homeland/blob/master/twa/index.html) v oblasti promítání
- [X] Konfigurace serveru pomocí .htaccess (chybové stránky, přesměrování, heslo, omezení na základě IP adres).
- celá konfigurace viz [.htaccess](https://github.com/davidvancl/Homeland/blob/master/twa/.htaccess)
- [X] Klientský JavaScript (přepínání CSS, geolokace, rozšířená validace formuláře)
- každá stránka má svůj .js soubor kde je něco málo ke stránce
- na desktop může být JS blokovaný a vše bude fungovat
- soubory ke stránkám lze nalézt [zde](https://github.com/davidvancl/Homeland/tree/master/twa/Scripts)
- [X] Serverový skript v PHP (zpracování formuláře)
- zpracování kontaktního formuláže
- [soubor pro zpracování formuláře](https://github.com/davidvancl/Homeland/blob/master/twa/Scripts/save_contact_service.php)

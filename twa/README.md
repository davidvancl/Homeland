# Grand Theft Auto V - TWA (Body obsažené v semestrálním projektu)
#### Požadavky na HTML:
- [X] oddělené záhlaví, zápatí menu a obsah, vytvořené pomocí sémantických elementů HTML5
- Každá stránka obsahuje záklaví (nadpis stránky), navigační menu, tělo, zápatí(odkazy a citace)
- [X] menu vytvořené pomocí seznamu s příslušným stylem
- Pro desktop je menu v záhlaví stránky, pro mobily jse pod záhlavím (seznam je využit bez dekorativních doplňků)
- [X] odstavce a nadpisy 1 - 3 úrovně
- Nadpisy jsou využívány dle důležitosti H1 - H4 po celém projektu
- [X] číslovaný a nečíslovaný seznam (každý minimálně celkem 7 položek ve dvou úrovních)
- číslovaný seznam na stránce "galerie" jako navigační panel u obrázků a videí
- nečíslovaný seznam na stránce "kontakty" jako zobrazení pracovníků (upravené dekorace)
- [X] odkazy z textu obsahu a odkazy na fragment stránky
- odkazy na fragmenty stánky jsou na stránce "galerie" v podobě navigačního panelu
- odkazy na jiné stránky jsou př. na "úvodní stránce" u článků jako "přečtěte si více"
- [X] minimálně 3 obrázky jako součást hlavního obsahu stránky
- obrázky jsou na "úvodní" stránce v promítání, nebo v "galerii"
- [X] tabulku s popiskem a záhlavím, využívající spojování buněk v horizontálním i vertikálním směru
- tabulka je dostupná na stránce "historie" (slévání sloupečků a řádků proběhne v ránci JS, kvůli responsivitě na mobilní zařízení)
- [X] formulář obsahující minimálně 3 viditelné elementy, využívající fieldset, legend a label
- na stránce "kontakty", formulář zpracovávající inforace a ulkádá je do DB
- [X] syntakticky vyznačené zvýraznění a zkratky (em, strong, abbr)
- doplňky textu jsou na hlavní stránce v jhednotlivých článkách, (abbr - na "kontakty" jako zvýraznění pozice zaměstnance)

---

#### Požadavky na CSS:
- [X] barva písma a pozadí
- každá stránka má rozdílné pozadí pro desktop a pro mobily (každé specificky upravené pro dané rozlišení)
- barva písma (skoro každý prvek, kde je text)
- [X] font a velikost písma
- úprava nadpisů, podnadpisů a veškerého textu ve stránce
- [X] nastavení chování odkazů (navštívený, aktivní, ...)
- příkladem je navigační panel na stránce "galerie", odkazy se mění barevně podle navštívenosti
- [X] nadpisy
- lze najít kdekoliv kde je (article, section, header, ... )
- [X] responzivní chování stránky ve dvou úrovních
- stránka je vytvořena tak aby byla funkční na všech zařízeních (někde víc, někde míň), ale neměla by se nikdy rozbít (kolize textu, obrazku, overflow, ...)
- [X] flexibilní rozložení obsahu v závislosti na rozlišení
- většina obsahu je navžena tak aby při určité šířce se nastavil display: block, pouze vzácně se využívá statických pozic, většina jsou %
- [X] responzivní menu
- pro desktop je menu v header, pro uživatele jednodušší
- na mobilu je pod header aby nemuselo být zbytečně malé a nenarušovalo header panel, tak je pod header připojen s možností rozkliku

---

#### rozšiřující úkoly:
- [X] HTML5 média (audio, video, figure)
- všechny alementy se nachází na stránce "galerie", další figure je promítání na "úvodní" stránce
- [X] HTML5 formuláře (nové atributy a typy)
- kompletní formulář s elementy na stránce "kontakty"
- klientská vlidace je separovaná v .js souboru, validace serverová je v souboru .php
- po zvalidování na serveru je kontaktní form uložen do DB 
- [X] Alternativní barevné schéma a rozložení CSS
- jakákoliv stránka
- [X] CSS pro tiskový výstup (skrytí navigace)
- stránka "galerie" navigační panel je skryt, na :hover je rozbalen
- [X] Pokročilé funkce CSS (generování obsahu)
- na stránce "historie" při zmenšení tabulky pro mobily se vygenerují popisky pro jednotlivé řádky
- [X] Rozšířené vlastnosti z CSS3 (animace, přechodové efekty, transformace, nové vlastnosti, vlastní fonty)
- animace je třeba v "úvodu" promítání obrázků
- přechodové efekty využity př. nav panel na každé stránce
- celý web je ve fontu použitý v GTA
- [X] Pokročilá responzivita CSS (širší škála podporovaných rozlišení, responzivní média)
- podpora pro 'snad všechna rozlišení'
- [X] Využití vloženého SVG v HTML nebo CSS
- SVG je ikonka(logo) v "úvodu" v oblasti promítání
- [X] Konfigurace serveru pomocí .htaccess (chybové stránky, přesměrování, heslo, omezení na základě IP adres)
- celá konfigurace viz .htaccess
- [X] Klientský JavaScript (přepínání CSS, geolokace, rozšířená validace formuláře)
- každá stránka má svůj .js soubor kde je něco málo ke stránce
- na desktop může být JS blokovaný a vše bude fungovat
- [X] Serverový skript v PHP (zpracování formuláře)
- zpracování kontaktního formuláže

<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$newton["title"] = "Redovisning";

$newton["main"] = <<<EOD
<article class="articleMain">
<h1>Redovisning</h1>
<h2>Kmom01</h2>

<p>Jag använder Windows 8, Atom som texteditor och XAMPP som server.</p>

<p>PHP-guiden var inte helt ny eftersom den även användes i htmlphp, men jag behöver fortfarande
repetition vid flera tillfällen så den är bra att ha till hands tillsammans med php-manualen.</p>

<p>Min webbmall fick heta Newton.

<p>Första reaktionen på kursen och det här momentet var att det kändes avancerat och
alldeles för mycket att ta till sig. Jag har tagit mig genom momenten med hjälp av
exempelkoden och kan väl säga att jag har fått ett hum om strukturen men är långt ifrån att
behärska den. Även om det var överväldigande så inser jag att ramverket är en avgörande del
i webbprogrammeringen, speciellt i längden för att på ett smidigt sätt ändra och bygga vidare på
en hemsida. Ännu mer om det är någon annan som ser över ens kod.</p>

<p>Jag valde att inte använda en klass till min navbar. Har inte riktigt lärt mig dessa än
men såg att det förklaras mer i nästa moment så jag tar det då.</p>

<p>Det gick helt ok att inkludera sourcen. Vid första koll så hamnade källkoden även högst upp på sidan, förutom på
sin rätta position. Men efter några justeringar hamnade allt på sin plats.</p>

<p>Jag har inte lagt upp min webbmall på GitHub.</p>

<h2>Kmom02</h2>
<p>Det är första gången jag lär mig på riktigt om klasser, objekt och metoder. Konceptet har visats sig lite grann i htmlphp
men jag fick ingen riktig kunskap om det. Jag har förstått att det är en stor del av programmering i helhet men innan har jag
inte vetat exakt vad objektorienterad programmering innebär.</p>

<p>Jag jobbade igenom guiden så noga jag kunde och har använt den vid sidan under hela momentet. Eftersom allt är väldigt nytt
just nu och innehållet mer avancerat än htmlphp så känns läromaterialet ännu viktigare att lära sig grundligt. Det är med guiden
och boken 'Beginning PHP and MySQL: From Novice to Professional' som jag har fått all kunskap från i detta moment.</p>

<p>Jag valde att göra tärningsspelet då det kändes som rätt nivå för mig och för guiden redan hade introducerat till den.
För att lösa uppgiften så utgick jag ifrån samma katalogstruktur och klasser som instruerades i guiden. Har även tjuvkikat på andra
för vägledning men anstränger mig samtidigt för att göra det mesta själv.
Jag har en klass för tärningen, en för spelrundan och en som visar spelet. Jag tog bort klassen CDiceImage då jag inte förstod
vad den tillförde när funktionen GetRollsAsImageList även fick finnas i CDiceHand. En klass som heter CDiceView presenterar hela spelet med
en funktion som kollar läget för session-variabeln 'dicehand' och hämtar \$_GET-variabler för kasta, spara och starta nytt spel.
Kombinerat med funktioner från CDiceHand lagras sedan allt input i variabeln \$html som sedan returneras.</p>

<p>Jag har inte riktigt greppat den objektorienterade programmeringen än och det tar en del tid för mig att slutföra uppgifterna.
Resultatet blir att jag får en hyfsad förståelse för vart och hur all information hanteras, men långt ifrån att kunna upprepa det
hela på ett blankt papper.
Bestämmer mig för att inte göra några extrauppgifter och kommer att lägga mest fokus på själva logiken och förståelsen framöver.
Hade väldigt gärna gjort kalendern då det känns som en mer användbar kunskap men just nu jag gör mitt bästa för att inte sitta för länge med
uppgifterna och väljer därför att avstå.</p>

<p>Något som ändå blev lite av en extrauppgift var den visuella effekten att få spelrundans tärningsslag att visas allihopa på en rad.
Detta löstes genom att låta arrayen lastRoll adderas istället för att ersättas med nytt värde. Arrayen printas sedan ut med en foreach-loop
och nollställs som förväntat vid etta, sparande eller nytt spel.</p>

<p>I övrigt så tycker jag att uppgiften var bra då den tvingade en till att tänka själv. Även fast det var svårt och krävde en del tid
så vill jag ändå erkänna att det är så här uppgifterna bör vara. Det krävs mer ansträngning för att lära sig men jag är övertygad om att
man kommer ihåg innehållet bättre och får lättare att återuppta lärdomarna och verktygen efter en tid med något annat.</p>
<h2>Kmom03</h2>
<p>Den första kontakt jag fick med databaser och SQL var i htmlphp-kursen där vi arbetade med SQLite. Jag har ingen direkt uppfattning än
om vad som skiljer med MySQL men när det gäller SQL-kodandet så kände jag mig bra introducerad från tidigare kurs.</p>

<p>När jag skulle installera klienterna var det första problemet att jag inte hade tillgång till att generera ett lösenord till BTHs
databas, men det gick snabbt att få hjälp med det via IT Helpdesk. Nästa problem jag fick och inte har löst var med Workbench som inte ville ansluta till
blu-ray-servern. Det som händer är att Workbench vill rapportera en bug så fort jag försöker ansluta med de angivna uppgifterna.
Om jag provar att kryssa i "old authentication protocol" så får jag meddelandet "Unsupported option provided to mysql_options()". Det känns som att jag
missar något men jag har provat att installera om programmet och uppgifterna är kontrollerade flera gånger.
</p>

<p>Även fast jag inte lyckades ansluta med Workbench så använde jag det som verktyg för att genomföra övningarna, då på lokal server.
Fann det väldigt enkelt att arbeta med och det gick lätt att förstå. PhpMyadmin provade jag mer i efterhand för att utforska hur det ser ut
att arbeta mot skoldatabasen. Det kändes lika användarvänligt som Workbench och blir inga problem med att jobba med framöver.
Använde mig i stort sett inte alls av CLU, mer än att testa att det fungerade. På den nivån jag är så känns det mer tilltalande att använda en klient som är mer
förklarande grafiskt sett.</p>

<p>SQL-övningen var nyttig och det mesta var bekant sedan innan men att använda vyer och funktionerna för datum och tid var nytt för mig. Inner och outer join
hade jag lite koll på sedan innan men fick definitivt mer inblick i det nu. Det kändes bra att göra flera småuppgifter, likt labbarna i htmlphp. Det blir lättare
att hänga med och förstå lösningarna steg-för-steg.</p>

<p>Jag avslutade med att läsa "Kokbok för databasmodellering" vilket var bra läsning.
Har sneglat lite på projektet för kursen och att inför detta kunna rita upp sin databas och hur den ska fungera i förhand blev väl förklarat i denna text.</p>
<h2>Kmom04</h2>
<p>Det här var ett rejält moment och med de krävande uppgifterna har det också tagit en del tid.
Det går bättre och bättre för mig med den objektorienterade programmeringen och jag försöker att göra det mesta själv även om det är svårt att inte behöva kolla exempelkoden
eller andras lösningar. Att jobba med PHP PDO känns bra och det är hyfsat nytt för mig. Har använt mig av det lite grann tidigare men inte riktigt greppat det
för ens nu då kunskapen om objekt i sig blivit större.</p>

<p>Jag började med att läsa guiden till filmdatabasen men väntade med att skriva någon kod tills det skulle användas i uppgift 3. Jag följde övningarna med CDatabase
och fann uppgiften väldigt lärorik med sina korta steg-för-steg instruktioner, även om det var lite oklart om test.php skulle redovisas. Ibland kan jag önska att vissa
instruktioner borde vara mer lik den här, istället för att få större kodbitar att ta till sig direkt. Jag saknar även labbarna från htmlphp och den här övningen bjöd på
lite samma koncept så det var uppskattat.</p>

<p>När jag började med uppgiften "Generera en HTML-tabell från en databastabell" så kändes det till en början aningen hopplöst då jag inte blev klok på hur jag skulle
bygga upp klasserna. Jag kollade hur andra hade löst uppgiften och fokuserade nog mer på att försöka använda det som jag lättast kunde förstå, än det som kanske var den bästa lösningen.
</p>

<p>I mitt resultat så hämtas get-variabler för sök, paginering och sortering i sidkontrollern movies.php. Dessa hanteras sedan i CMovieSearch som använder sig av CDatabase och
ställer SQL-frågan mot databasen. CHTMLTable printar en tabell med resultatet från CMovieSearch samt presenterar sidnavigering. Pagineringen och "matematiken" bakom lösningen var
en rolig del att applicera. Jag lärde mig en metod för paginering på egen hand i htmlphp men fann den här lösningen smidigare då den krävde färre kodrader. </p>

<p>Efter filmdatabasuppgiften kände jag mig betydligt säkrare på klasserna och började göra klassen för användarhantering, CUser, helt på egen hand. Med koden från guiden fick
jag till en helt fungerande klass med metoder för autentisering, logga in och logga ut. Konstruktorn kollar om den finns en inloggad användare. Användarnamn och lösenord hämtas
i sidkontrollern via post och om dessa är angivna så anropas metoden Login(). Där används CDatabase för att ställa SQL-frågan mot databasen. </p>

<p>Även om ramverket inte riktigt har landat hos mig ser jag hur de olika klasserna lätt kan återanvändas då de är relativt självständiga.
Det här momentet har gjort mig säkrare på SQL, PDO och klasshantering. Innan förstod jag hur klasserna fungerade, men inte tillräckligt för att själv kunna skriva koden från grunden.
Jag har även lärt mig mig hur en SQL-fråga lätt kan modiferas med användarens input. Klassen CDatabas har varit väldigt hjälpsam och jag har flitigt använt debug='true' för felsökning.</p>
<h2>Kmom05</h2>
<p>Ett roligt kursmoment med verktyg som garanterat kommer vara användbara i framtiden. Det är fortfarade utmanande att lista ut hur klasserna ska byggas men jag tyckte att det här
momentet gick lättare än det förra.</p>

<p>Övningen med CTextFilter var inga problem att genomföra och det var enkelt att förstå hur den skulle användas, däremot svårare att greppa koden helt och hållet från funktionerna i klassen.
Oavsett så är det en riktigt smart konvertering mellan html och läsbar text. När jag började koda klasserna kände jag mig betydigt säkrare än tidigare och instruktionerna med exempelkoden var en
enkel process att styra över till de tre klasserna. Klasserna är sammanslutna på ett sätt där de ansluter till övre klass i sin konstruktor. CBlog och CPage ansluter allså till CContent och CTextFilter,
där CContent ansluter till CDatabase. Antar att extends även skulle fungera i sammahanget och det kanske är en bättre lösning, men jag kände att min kunskap räckte till detta i nuläget.</p>

<p>CContent innehåller alla funktioner för att initiera, återställa och ändra tabellen content. CBlog och CPage har endast funktionen att hämta och presentera innehållet för blog eller page.
Att ändra i tabellen kräver inloggning.</p>

<p>Att hitta struktur för klasserna har blivit lättare med momenten. Det känns som att när man väl har en idé vart allt bör befinna sig så är funktionerna och anslutningen mellan klasser och
sidkontroller den lätta biten.</p>

<p>Det är verkligen en bra bas med moduler på me-sidan och även om det inte är mycket för ögat just nu så är det ändå som sagt grunden för många webbsidor. Jag tycker att de moduler vi har
tillfört så här långt har varit helt i sin ordning och på ett rimligt steg i utvecklingen av sidan. Om det är något jag saknar så skulle det vara möjligheten att ladda upp filer på sidan och att kunna
visa flöden från sociala medier.</p>
<h2>Kmom06</h2>
<p>Jag har ingen erfarenhet vad det gäller bildhantering och webb sedan förut, däremot har jag använt en del photoshop för redigering och beskäring av bilder. Att hantera bilder som i detta moment känns direkt
som ett användbart medel framöver.</p>

<p>Det känns bra att jobba med PHP GD men jag har inte riktigt satt mig in i det än. Har sett att det finns många funktioner att använda sig av och de är oftast självförklarande via sina namn,
men jag har inte kollat exakt hur var och en fungerar av de som används i img.php. Det var enkelt och smidigt att använda parametrarna till bilderna.</p>

<p>Att följa guiden till img.php tyckte jag var svårt och väldigt mycket att ta till sig. Jag följde den steg för steg och uppskattande verkligen att koden även presenterades i 'grova' drag då det
som sagt var ganska mycket på en gång. När själva koden var på plats så använde jag mig mycket av 'verbose' som visade sig vara väldigt smidig i felsökandet. Förståelsen för koden kommer ju mer jag
går i genom den och framför allt när den ska förflyttas till en klass känner jag att detaljerna blir klarare.</p>

<p>Koden till själva galleriet tyckte jag också var rätt svår att hänga med i. Samma som tidigare så hjälper kodandet av klassen att förstå delarna i den större koden. I klassen ska allt fungera som det ska,
förutom att min breadcrumb inte visar korrekt i mapp efter Hem. Just nu blir mappen en del av bildnamnet, ex. Hem >> me/me1.jpg istället för Hem >> me >> me1.jpg. Detta har jag alltså inte löst än. Edit:
Såg nu att problemet endast visar sig i lokal miljö, på studentservern är det som det ska.</p>

<p>Ramverket gör det enkelt att bygga på hemsidan och jag känner mig bekväm med att jobba med det. Eftersom hemsidor kan vara väldigt olika så har jag tänkt på hur ramverken kan skilja sig åt och hur de
bör struktureras för att gynna hemsidans syfte. Det är svårt att säga om det är någon modul jag saknar i nuläget. Det känns som att det är en bra grund som har byggts inför projektet.</p>

<p>Detta var nog det svåraste och mest krävande momentet hittills. Det kändes som att jag direkt blev tvungen att prioritera hur mycket tid jag kunde ägna åt att förstå varje del för att inte sitta fast för länge.
Som vanligt så får jag under momentets gång tillräcklig förståelse för att kunna ändra och felsöka, men att kunna koda liknande funktioner från grunden och föreslå förbättringar känns fortfarande ganska långt bort.</p>

</article>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);

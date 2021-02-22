<body class="Site">
<main class="Site-content">
    <div class="documentationContainer">
        <h2>Projektdokumentation ProTec - ein GWP/DWP-Projekt</h2>

        <h3>1. Projektbeschreibung</h3>
        <p>
            Im Rahmen der Module Dynamische Webprogrammierung und Grundlagen Webprogrammierung soll eine Webseite für
            einen Online-Shop entworfen und implementiert werden. Im Rahmen der
            Themenfindung wurde ein Webshop für Elektronik, Computer, Computerteile und RaspberryPi sowie zugehörige
            Komponenten gewählt. Dabei ist es nach Anmeldung möglich verschiedenste
            Produkte hinzuzufügen und im Anschluss auch zu kaufen. Zu jedem Produkt ist eine Produktseite verfügbar, auf
            der der Preis, kurze Infos sowie eine detaillierte Beschreibung des
            Produkts vorhanden sind. Das eigene Profil kann eingesehen und zugehörige Versanddaten, Zahlungsdaten und
            Accountdaten geändert werden. Auch können die eigenenen Käufe eingesehen werden
        </p>
        <br><br>

        <h3>1.1 Recherche und Rechercheergebnisse</h3>
        <p>
            Bei der Findung der Grundidee recherchierten wir hauptsächlich auf Seiten für den technisch/elektronischen Bedarf.
            Wichtig war für uns hierbei Elemente zu entdecken, die wir gerne für uns adaptieren möchten, aber auch Elemente,
            die wir eher störend empfanden und gerne anders umsetzen würden. Berrybase.de war unser erster Anhaltspunkt an
            dem wir unsere Recherche begannen. Ein simpler Webshop für den Technikbastler. Bei unserer Suche trafen wir ebenfalls
            auf Webshops die wir als "erschlagend" überladen empfanden, so zum Beispiel die Website von reichelt.de. 

            Erklärtes Ziel war es nach kurzer Zeit, einen Webshop zu entwickeln, der nicht überladen mit Inhalten, sowohl für den 
            Einsteigerbastler als auch für den fortgeschrittenen Bastler,  eine Möglichkeit bietet, durch die "Regale" zu schlendern
            und sich inspirieren zu lassen, zu neuen Projekten.
        </p>
        <br><br>
        <p>
            Für die Recherche genutze Webpräsenzen:
            
        
        </p>
        <a href="https://www.berrybase.de">https://www.berrybase.de</a>
        <a href="https://www.reichelt.de">https://www.reichelt.de</a>
        <a href="https://www.conrad.de">https://www.conrad.de</a>
        
        <h3>2. Anforderungsbeschreibung</h3>
        <h4>2.1 Muss-Kriterien</h4>
        <ul class="mustHaveCriteria">
            <li>
                <u>Allgemein</u>
                <ul>
                    <li>Webseitenstruktur mit mindestens 6 Seiten und 3 Unterseiten</li>
                    <li>einheitliche Navigation mit Untermenüs über das gesamte Webportal</li>
                    <li>mindestens 3 Formulare (Login, Registrierung und Kontaktformulare)</li>
                    <li>Datenbankanbindung mit Beispieldaten</li>
                    <li>Schreib- und Lese-Zugriff auf Datenbank</li>
                </ul>
                <br>
            </li>
            <li>
                <u>GWP</u>
                <ul>
                    <li>passende Gestaltung, dem Thema entsprechend</li>
                    <li>Barrierefreiheit durch Verwendung von Meta, Alt, Title Tags</li>
                    <li>Einbindung von Bildern</li>
                    <li>Gliederung durch HTML-Elemente wie div, nav, header, article, section</li>
                    <li>responsives Webdesign (mobile-friendly und Desktop-konform)</li>
                </ul>
                <br>
            </li>
            <li>
                <u>DWP</u>
                <ul>
                    <li>Behandlung und Validierung von Formularen mittels PHP serverseitig und Javascript
                        clientseitig
                    </li>
                    <li>dynamischer Aufbau von Seiten anhand von Daten aus der Datenbank</li>
                    <li>Sortierung von Produkten nach mindestens 3 Parametern, Verknüpfung mit UND oder ODER
                    </li>
                    <li>vorhandene Nutzeraccounts</li>
                    <li>Nutzerregistrierung</li>
                    <li>Fehlerbehandlung für nicht bekannte Seiten (404)</li>
                    <li>Dynamisches Nachladen von Inhalten mittels JavaScript, wo sinnvoll</li>
                </ul>
                <br>
            </li>
        </ul>
        <h4>2.2 Wunsch-Kriterien</h4>
        <ul class="couldHaveCriteria">
            <li>
                <u>GWP</u>
                <ul>
                    <li>Animationen und Überblendungen für angenehme User Experience</li>
                    <li>Stilangaben für Druckausgabe (z.B. Bestellbestätigung, Produktübersicht)</li>
                </ul>
                <br>
            </li>
            <li>
                <u>DWP</u>
                <ul>
                    <li>asynchrones Absenden von Formularen mittels AJAX</li>
                </ul>
                <br>
            </li>
        </ul>
        <br><br>

        <h3>3. Zu liefernde Funktionalitäten (inkl. zugehörigem Entwickler)</h3>
        <table class="functionalities">
            <thead>
            <tr class="functionalitiesHeaderRow">
                <th>Funktionalitäten</th>
                <th class="developerColumn">Entwickler</th>
            </tr>
            </thead>
            <tbody>
            <tr class="functionalitiesRow">
                <td>
                    <br>
                    <ul>
                        <li>Homepage</li>
                        <li>Warenkorb</li>
                        <li>Kaufprozess</li>
                        <li>Unterkategorieseiten</li>
                        <li>Produktseiten</li>
                        <li>Administratormenü + Konto</li>
                        <li>Footer Menü</li>
                        <li>Infoseiten</li>
                        <li>Produktbilder + Produkteinträge in Datenbank</li>
                        <li>Grundstruktur MVC</li>
                        <li>Grundfunktionen in Core/Model, Core/Controller etc.</li>
                        <li>Error-Seite</li>
                        <li>CSS Anpassungen Mobile-friendly, Tablet-friendly</li>
                        <li>Datenbankentwurf</li>
                    </ul>
                    <br>
                </td>
                <td class="developerColumn">Niklas Wiemuth</td>
            </tr>
            <tr class="functionalitiesRow">
                <td>
                    <br>
                    <ul>
                        <li>Login, Registrierung - Formulare und Validierung</li>
                        <li>Komplexitätstest für Passwörter (Mindeststandards für Sicherheit)</li>
                        <li>Serviceseiten inkl. Kontaktformular</li>
                        <li>Profil(-bearbeitung)</li>
                        <li>Session- & Cookie-Management</li>
                        <li>Logik für "Angemeldet bleiben"</li>
                        <li>Oberkategorieseiten</li>
                        <li>Partner im Footer</li>
                        <li>Produktsuche inkl. Sortierung & Filterung</li>
                        <li>Installationsanweisungen</li>
                        <li>Recherche Beispielprodukte</li>
                        <li>Beispieldaten für Datenbank</li>
                        <li>Testaccounts</li>
                        <li>Firmenlogo</li>
                    </ul>
                    <br>
                </td>
                <td class="developerColumn">Thomas Gebel</td>
            </tr>
            <tr class="lastFunctionalitiesRow">
                <td>
                    <br>
                    <ul>
                        <li>Header Navigationsleiste</li>
                        <li>Projektdokumentation</li>
                        <li>Grundaufbau Webseite; Abstraktion in fixe Header und Footer sowie veränderlicher Hauptteil
                        </li>
                        <li>Codedokumentation</li>
                        <li>Farbwahl</li>
                    </ul>
                </td>
                <td class="developerColumn">Gemeinsame Arbeit</td>
            </tr>
            </tbody>
        </table>
        <br><br>

        <h3>4. Webseitenstruktur</h3>
        <a class="websiteDiagramFull" href="/diagrams/WebsiteStruktur.png" target="_blank">
            <img class="websiteDiagram" src="/diagrams/WebsiteStruktur.png" alt="Webseitenstrukturdiagramm">
        </a>
        <br><br>

        <h3>5. Datenbankstruktur</h3>
        <a class="databaseDiagramFull" href="/diagrams/ProtecDBV1.1.png" target="_blank">
            <img class="databaseDiagram" src="/diagrams/ProtecDBV1.1.png" alt="Datenbankstrukturdiagramm">
        </a>
        <br><br>

        <h3>6. Projekt(-ordner-)struktur</h3>
        <a class="projectStructureDiagramFull" href="/diagrams/projectStructure.png" target="_blank">
            <img class="projectStructureDiagram" src="/diagrams/projectStructure.png" alt="Projektstrukturdiagramm">
        </a>
        <br><br>

        <h3>7. Verwendete Software</h3>
        <ul>
            <li>IDE - <a href="https://www.jetbrains.com/de-de/phpstorm/" target="_blank"></a>PHPStorm</li>
            <li>IDE - <a href="https://code.visualstudio.com/" target="_blank"></a>Visual Studio Code</li>
            <li>Versionskontrolle, Issue-Tracking, ToDo-Liste - <a href="https://github.com/" target="_blank"></a>Github
            </li>
            <li>Webserver Software - <a href="https://www.apachefriends.org/de/index.html" target="_blank"></a>XAMPP
            </li>
            <li>Software für schnelle Kommunikation - <a href="https://desktop.telegram.org/" target="_blank"></a>Telegram
            </li>
            <li>Software für regelmäßige Meetings - <a href="https://www.webex.com/de/unified-homepage-081220201.html"
                                                       target="_blank"></a>Webex
            </li>
            <li>Software für Präsentationen und Dokumente - <a href="https://www.microsoft.com/de-de/microsoft-365"
                                                               target="_blank"></a>Microsoft Office
            </li>
            <li>Datenbankentwurf und Erstellung von Datenbankdiagrammen - <a
                        href="https://www.mysql.com/de/products/workbench/" target="_blank"></a>MySQL Workbench
            </li>
        </ul>

    </div>


</main>
</body>



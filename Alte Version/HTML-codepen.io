<!DOCTYPE html>
<hmtl>
<body>
    <h1>Produktsuche in meinem Webshop</h1>
  
      <input type="text" id="suchbegriff" placeholder="Suchbegriff eingeben">
    <button onclick="sucheProdukte()">Suchen</button>
  
    <section id="ergebnisse">
        <!-- Hier werden die Suchergebnisse angezeigt -->
    </section>

    <script>
        function sucheProdukte() {
            const suchbegriff = document.getElementById('suchbegriff').value.toLowerCase();
          <!-- mit getElementById wird der DOM nach passenden Suchbegriffen durchsucht, durch .value.toLowerCase() wird die Eingabe in Kleinbuchstaben umgewandelt ohne den Inhalt zu verändern.  -->

            const ergebnisseDiv = document.getElementById('ergebnisse');
           <!-- hier werden die von der Funktion getElementById in der Variablen ergebnisseDiv zwischengespreicherten gefundenen Ergebnisse an die Variable ergebnisse übergeben.  -->
          
 //Produkt-Datenbank
    const produktDatenbank = [
    { id: '213jido12', name: 'USB-C-Stick 128GB', preis: 29.99 },
    { id: '12ocdnkl5', name: 'USB-Festplatte 1TB', preis: 99.99   },
    { id: '123mk89d', name: 'Fernseher OLED 55 Zoll', preis:     599.98 },
    { id: '89dsahui029', name: 'TFT-Display 55 Zoll', preis: 349.00 },
    { id: '83bdsan00', name: 'Digitalkamera 50 Megapixel', preis: 129.49 },
    { id: '034ndjakl123', name: 'Digitalkamera 45 Megapixel', preis: 109.49 },
            ];
          
 <!-- Erste einfache html Lösung ohne Berücksichtigung des geforderten Datenmodells -->
          
                      // Suchergebnisse filtern
            const ergebnisse = produktDatenbank.filter(produkt => produkt.name.toLowerCase().includes(suchbegriff));

<!-- durch .name.toLowerCase() wird die Eingabe in Kleinbuchstaben umgewandelt ohne den Inhalt zu verändern. Hier wird die Datenbank nach bestandteilen des Suchbegriffs durchsucht und Treffer an die Varibale ergebnisse übergeben -->

            // Ergebnisse anzeigen
          

<!-- was tut diese Zeile??? -->
            if (ergebnisse.length > 0) {
              <!-- wenn ergebnisse nicht leer ist wird diese Bedingung ausgeführt. -->
                ergebnisseDiv.innerHTML = 
<!-- was tut diese Zeile??? -->
`<p>${ergebnisse.length} Produkte gefunden:</p>`;
              <!-- Anzahl der gefundene Produkte wird ausgegeben. -->
                ergebnisse.forEach(produkt => {
                    ergebnisseDiv.innerHTML += `<p>${produkt.name} - ${produkt.preis} €</p>`;
                  <!-- Der zum Suchergebnis passende Name und Preis werden ausgegeben. -->
                });
            } else {
                ergebnisseDiv.innerHTML = 'Keine Produkte gefunden.';
              
<!-- Wenn kein passendes Produkt gefunden wurde erfolgt die Meldung: Keine Produkte gefunden. -->
            }
        }
    </script>
</body>
</html>

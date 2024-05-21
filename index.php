<?php
    #Variabili per Parking e Voto
    $park_status =  isset($_GET["parking"]) ? $_GET["parking"] : "";
    $hotel_vote =  isset($_GET["votation"]) ? $_GET["votation"] : "";
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Hotel</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <!-- 
        Bonus : 
        1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
        2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
    -->
    <section class="ms_container ms_items-center">
        <h1 class="ms_p-2 ms_title">PHP Hotel &star; </h1>
        <form action="index.php" method="GET" class="ms_form-section">
            <p class="ms_p-2">
            <label for="park">Parcheggio :</label>
            <select name="parking" id="park">
                <option value=""></option>
                <option value="true">Si</option>
                <option value="false">No</option>
            </select>
            </p>
            <p>
                <label for="vote">Inserisci il voto minimo per l'hotel :</label>
                <input type="text" name="votation" id="vote">
            </p>
            <button type="submit">Invia</button>
            <button type="reset">Reset</button>
        </form>

        <section class="ms_card-section">
            <!-- Se entrambi sono vuoti mostro tutti gli hotel -->
            <?php if(empty($park_status) && empty($hotel_vote)) { ?>
                <!-- Ciclo di visualizzazione standard degli Hotel -->
                <?php foreach($hotels as $cur_hotels) { ?>
                    <div class="ms_card">
                        <h4><?php echo $cur_hotels['name'] ?></h4>
                        <p><?php echo $cur_hotels['description'] ?></p>
                        <p><?php echo $cur_hotels['vote'] ?></p>
                        <p><?php echo $cur_hotels['distance_to_center'] ?></p>
                        <!-- Applico il controllo, visto che non voglio stampare 0 o 1 -->
                        <p>Parcheggio : <?php echo $cur_hotels['parking'] ? "Si" : "No" ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!-- Controllo lo status delle variabili -->
                <?php
                foreach($hotels as $cur_hotels) {
                    #Utilizzo una variabile d'appoggio dal valore booleano
                    # 1. Controllo se vuoto (True = Vuoto)
                    # 2. Quindi se non è vuoto controllo se park_status corrisponde e combacia (Controllo se cur_hotels['parking'] è Vera o Falsa)
                    # 3. Quel valore di cur_hotels['parking'] corrisponde a quello selezionato dall'utente in $park_status
                    # 4. Essendo una condizione che è sempre vera, soddisfa la condizione di visualizzazione
                    $park_bool = empty($park_status) || ($park_status === ($cur_hotels['parking'] ? "true" : "false"));
                    # 1. Controllo se vuoto
                    # 2. Controllo se il voto è >= $hotel_vote ossia quello inserito dall'utente
                    # 3. Elimina hotel sottosoglia di voto
                    $hotel_check = empty($hotel_vote) || $cur_hotels['vote'] >= $hotel_vote;
                    #Condizione di visualizzazione
                    if($park_bool && $hotel_check){ ?>
                        <div class="ms_card">
                            <h4><?php echo $cur_hotels['name'] ?></h4>
                            <p><?php echo $cur_hotels['description'] ?></p>
                            <p>Voto : <?php echo $cur_hotels['vote'] ?></p>
                            <p>Distanza dal centro : <?php echo $cur_hotels['distance_to_center'] ?></p>
                            <!-- Applico il controllo, visto che non voglio stampare 0 o 1, Se True = "Si" , Altrimenti "No" -->
                            <p>Parcheggio : <?php echo $cur_hotels['parking'] ? "Si" : "No" ?></p>
                        </div>
                    <?php }
                    }
                ?>
            <?php } ?>
        </section>
        
    </section>
</body>
</html>

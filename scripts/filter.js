console.log('filter.js chargé');

$(document).ready(function() {
    // Lorsque le bouton de filtrage est cliqué
    $('#applyFilters').click(function() {
        // Capturer les valeurs des filtres
        let price = $('#price').val();
        let mileage = $('#mileage').val();
        let year = $('#year').val();
        console.log(price, mileage, year);
        
        // Envoyer une requête AJAX au serveur
        $.ajax({
            url: 'filter_cars.php',
            method: 'GET',
            data: {
                price: price,
                mileage: mileage,
                year: year
            },
            dataType: 'json',
            success: function(data) {
                // Mettre à jour la zone d'affichage des résultats
                let html = '';
                data.forEach(function(car) {
                    // Construire le HTML pour chaque voiture
                    html += '<div class="col-md-6">';
                    html += '<div class="card h-100">';
                    if (car.image_path) {
                        html += '<img src="' + car.image_path + '" class="card-img-top" alt="Image de la voiture">';
                    }
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title"><a href="cars_read.php?id=' + car.car_id + '">' + car.title + '</a></h5>';
                    html += '<p class="card-text">' + car.car + '</p>';
                    html += '<p class="card-text">Kilométrage : ' + car.car_km + 'km</p>';
                    html += '<p class="card-text">Prix : ' + car.car_price + '€</p>';
                    html += '<p class="card-text">Année de mise en circulation : ' + car.year_of_registration + '</p>';
                    html += '</div></div></div>';
                });
                $('#results').html(html); // Utilisez la variable HTML pour mettre à jour la zone d'affichage
            },
            error: function() {
                alert('Une erreur est survenue lors du chargement des données.');
            }
        });
    });
});

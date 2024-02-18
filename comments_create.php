<?php
require_once(__DIR__ . '/isConnect.php');
?>

<form action="comments_post_create.php" method="POST">
    <div class="mb-3 visually-hidden">
        <input class="form-control" type="text" name="car_id" value="<?php echo($car['car_id']); ?>" />
    </div>
    <div class="mb-3">
        <label for="review" class="form-label">Evaluez le véhicule (de 1 à 5)</label>
        <input type="number" class="form-control" id="review" name="review" min="1" max="5" step="1" />
    </div>
    <div class="mb-3">
        <label for="comment" class="form-label">Postez un commentaire</label>
        <textarea class="form-control" placeholder="Soyez respectueux/se, nous sommes humain(e)s." id="comment" name="comment"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
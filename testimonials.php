<?php
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

$stmt = $mysqlClient->prepare("SELECT name, comment, rating FROM testimonies WHERE validated = 1");
$stmt->execute();
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php $index = 0; ?>
        <?php foreach ($testimonials as $testimonial) : ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                    <div class="card mb-3 mb-lg-0" style="max-width: 36rem; background-color:#F2F7EF;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $testimonial['name']; ?></h5>
                            <p class="card-text"><?php echo $testimonial['comment']; ?></p>
                            <p class="card-text">Note: <?php echo $testimonial['rating']; ?>/5</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev " type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" >
        <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next " type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
        <span class="visually-hidden ">Next</span>
    </button>
</div>



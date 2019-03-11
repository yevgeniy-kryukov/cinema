<?php

use cinema\models\ModelFilm;
use cinema\components\Utils;

?>
<h1 class="text-center my-2">Today's <?php echo $catName; ?> Top Picks</h1>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php
            for($ii = 0; $ii < min(3, count($listFilms)); $ii++):
                $itemTopFilm = $listFilms[$ii];
            ?>
            <div class="carousel-item <?php echo $ii == 0 ? "active" : ""; ?>">
                <img src="<?php echo ModelFilm::getPosterURI($itemTopFilm["id"]); ?>" alt="<?php echo $ii; ?> slide" class="d-block w-100">
                <div class="container">
                    <div class="carousel-caption 
                        <?php 
                        if ($ii == 1) { 
                            echo "text-left"; 
                        } elseif ($ii == 3) { 
                            echo "text-right"; 
                        } 
                        ?>
                        ">
                        <h1><?php echo Utils::HtmlEncode($itemTopFilm["title"]); ?></h1>
                        <p><?php echo Utils::HtmlEncode($itemTopFilm["description"]); ?></p>
                        <p>Genre <span class="font-weight-bold"><?php echo $itemTopFilm["categoryname"]; ?></span> Length <span class="font-weight-bold"><?php echo $itemTopFilm["length"]; ?> minutes</span> rating <span class="font-weight-bold"><?php echo $itemTopFilm["rating"]; ?></span>.</p>
                        <p><a class="btn btn-lg btn-primary" href="/show/film/<?php echo $itemTopFilm["id"]; ?>" role="button">Buy a ticket</a></p>
                    </div>
                </div>
            </div>
        <?php 
            endfor
        ?>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<hr class="featurette-divider">
<div class="container marketing">
    <?php       
    for ($ii = 3; $ii < count($listFilms); $ii++):
        $itemTopFilm = $listFilms[$ii];
        if ($ii%2 == 0) {
            $orderMD7 = "order-md-2";
            $orderMD5 = "order-md-1";
        } else {
            $orderMD7 = "";
            $orderMD5 = "";
        }
        ?>
    <div class="row featurette">
        <div class="col-md-7 <?php echo $orderMD7; ?>">
        <h2 class="featurette-heading"><?php echo Utils::HtmlEncode($itemTopFilm["title"]); ?>.</h2>
        <p class="lead"><?php echo Utils::HtmlEncode($itemTopFilm["description"]); ?>.</p>
        <p>Genre <span class="font-weight-bold"><?php echo $itemTopFilm["categoryname"]; ?></span> Length <span class="font-weight-bold"><?php echo $itemTopFilm["length"]; ?> minutes</span> rating <span class="font-weight-bold"><?php echo $itemTopFilm["rating"]; ?></span>.</p>
        <p><a class="btn btn-lg btn-primary" href="/show/film/<?php echo $itemTopFilm["id"]; ?>" role="button">Buy a ticket</a></p>
        </div>
        <div class="col-md-5 <?php echo $orderMD5; ?>">
        <img class="featurette-image img-fluid mx-auto" src="<?php echo ModelFilm::getPosterURI($itemTopFilm["id"]); ?>">
        </div>
    </div>
    <hr class="featurette-divider">
    <?php endfor ?>
</div>

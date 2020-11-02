<?php $this->title = 'Webaby - Articles'; ?>

<section id="articles">
    <h1 class="text-center">Tous les articles</h1>
    <div class="row">
        <?php foreach ($articles as $article) { ?>
            
            <div class="border border-dark col-6 mx-auto my-3 p-3">
                <p><?= $article->getTitle(); ?></p>
                <p><?= $article->getSentence(); ?></p>
                <p><?= $article->getContent(); ?></p>
                <p><?= $article->getUserPseudo(); ?></p>
                <p><?= $article->getPublishedAt(); ?></p>
                <img src="img/article/<?= $article->getFilename(); ?>" alt="">
            </div>

        <?php } ?>
    </div>
</section>
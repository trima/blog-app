<div class="container-fluid">
<h2><?php echo $title; ?></h2>

<?php foreach ($news as $news_item): ?>

        <h3><a href="<?php echo site_url('news/'.$news_item['slug']); ?>"><?php echo $news_item['title']; ?></a></h3>
        <div class="main">
                <?php echo $news_item['text']; ?>
        </div>

<?php endforeach; ?>
</div>

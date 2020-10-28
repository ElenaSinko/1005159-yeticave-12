<section class="lot-item container">
<!--    <h2>--><?//=$error;?><!--</h2>-->
<!--    <p>Данной страницы не существует на сайте.</p>-->
    <?php if(isset($error)): ?>
        <h2><?=$error;?></h2>
    <?php else:?>
        <p>Данной страницы не существует на сайте.</p>
    <?php endif;?>
</section>

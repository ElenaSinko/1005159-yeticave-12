<?php
require_once('functions/functions.php');
session_start();
?>

<nav class="nav">
    <ul class="nav__list container">
        <?php foreach($categories as $val): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=htmlspecialchars($val['title']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<div class="container">
    <section class="lots">
        <?php if(count($lots) != 0) :?>
        <h2>Результаты поиска по запросу «<span><?= $search?></span>»</h2>
        <ul class="lots__list">
            <?php foreach($lots as $val): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src=<?=$val['img']; ?> width="350" height="260" alt="<?=htmlspecialchars($val['title']); ?>">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=htmlspecialchars($val['category']); ?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$val['id']?>"><?=htmlspecialchars($val['title']); ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=format_price($val['base_price']); ?></span>
                            </div>
                            <?php
                            $time_to_expiration = calculate_time_to_expiration($val['date_expiration']);
                            ?>
                            <div class="lot__timer timer <?php if ($time_to_expiration[0] == 0): ?>timer--finishing<?php endif ?>">
                                <?=$time_to_expiration[0] . ':' . $time_to_expiration[1]?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
    <?php else: ?>
        <h2> По вашему запросу «<span><?= $search?></span>» ничего не найдено.</h2>
    <?php endif;?>
</div>

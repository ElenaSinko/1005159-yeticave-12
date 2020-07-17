<?php
function calculate_time_to_expiration ($date_expiration) {
    $date_expiration = strtotime($date_expiration);
    $current_date = strtotime(date('Y-m-d h:i:s'));
    $diff = $date_expiration - $current_date;
    $hours_expiration = floor($diff / 3600);
    if ($hours_expiration < 10) {
        $hours_expiration = str_pad($hours_expiration, 2, "0", STR_PAD_LEFT);
    };
    $minutes_expiration = floor(($diff - ($hours_expiration * 3600)) / 60);

    return [$hours_expiration, $minutes_expiration];
}
?>

<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $val): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=htmlspecialchars($val); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach($ads as $val): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src=<?=$val['img']; ?> width="350" height="260" alt="<?=htmlspecialchars($val['title']); ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=htmlspecialchars($val['category']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=htmlspecialchars($val['title']); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=format_price($val['price']); ?></span>
                        </div>
                        <div class="lot__timer timer <?php if (calculate_time_to_expiration($val['date_expiration'])[0] == 0): ?>timer--finishing<?php endif ?>">
                            <?=calculate_time_to_expiration($val['date_expiration'])[0] . ':' . calculate_time_to_expiration($val['date_expiration'])[1]?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

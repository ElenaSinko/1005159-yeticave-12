<nav class="nav">
    <ul class="nav__list container">
        <?php foreach($categories as $val): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?=htmlspecialchars($val['title']); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php $classname = count($errors) ? 'form--invalid' : ""; ?>
<form class="form form--add-lot container <?= $classname; ?>" action="add.php" method="post" enctype="multipart/form-data">
<h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : ""; ?>
        <div class="form__item  <?= $classname; ?>">
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot-name" value="<?=htmlspecialchars(getPostVal('lot-name')); ?>" placeholder="Введите наименование лота">
            <span class="form__error"><?= $errors['lot-name']; ?></span>
        </div>
        <?php $classname = isset($errors['category']) ? "form__item--invalid" : ""; ?>
        <div class="form__item  <?= $classname; ?>">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category">
                <option value="0">Выберите категорию</option>
                <?php foreach($categories as $val): ?>
                    <option value="<?= $val['id'] ?>" <?php if ($_POST['category'] == $val['id']){echo ' selected';}?>><?=htmlspecialchars($val['title']); ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?= $errors['category']; ?></span>
        </div>
    </div>
    <?php $classname = isset($errors['message']) ? "form__item--invalid" : ""; ?>
    <div class="form__item form__item--wide <?= $classname; ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"><?=htmlspecialchars(getPostVal('message')); ?></textarea>
        <span class="form__error"><?= $errors['message']; ?></span>
    </div>
    <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : ""; ?>
    <div class="form__item form__item--file form__item--invalid <?= $classname; ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" name="lot-img" id="lot-img" value="">
            <label for="lot-img">
                Добавить
            </label>
            <span class="form__error"><?= $errors['lot-img']; ?></span>
        </div>
    </div>
    <div class="form__container-three">
        <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--small <?= $classname; ?> ">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" value="<?=htmlspecialchars(getPostVal('lot-rate')); ?>" placeholder="0">
            <span class="form__error"><?= $errors['lot-rate']; ?></span>
        </div>
        <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--small <?= $classname; ?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" value="<?=htmlspecialchars(getPostVal('lot-step')); ?>" placeholder="0">
            <span class="form__error"><?= $errors['lot-step']; ?></span>
        </div>
        <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : ""; ?>
        <div class="form__item <?= $classname; ?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" value="<?=htmlspecialchars(getPostVal('lot-date')); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <span class="form__error"><?= $errors['lot-date']; ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>


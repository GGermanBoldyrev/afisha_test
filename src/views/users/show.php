<div class="model-header model-title model-title-fit">Просмотр роли</div>
<div class="single-model">
    <div class="model-id">
        <div>id</div>
        <div><?= $user['id'] ?></div>
    </div>
    <div class="model-no-id">
        <div>
            <div class="dev">Имя пользователя</div>
            <div><?= $user['name'] ?></div>
            <div class="dev-emp"></div>
            <div class="dev">Email пользователя</div>
            <div><?= $user['email'] ?></div>
            <div class="dev-emp"></div>
            <div class="dev">Роли пользователя</div>
            <div>
                <?php foreach ($roles as $role): ?>
                    <div class="role-name">- <?= $role['name'] ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="model-actions">
            <a href="/users/show/<?=$user['id']?>">Посмотреть</a>
            <a href="/users/edit/<?=$user['id']?>">
                Изменить
            </a>
            <a
                href="/users/delete/<?= $user['id'] ?>"
                onclick="return confirm('Вы уверены, что хотите удалить эту роль?')">
                Удалить
            </a>
        </div>
    </div>
</div>
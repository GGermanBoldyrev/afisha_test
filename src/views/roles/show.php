<div class="model-header model-title model-title-fit">Просмотр роли</div>
<div class="single-model">
    <div class="model-id">
        <div>id</div>
        <div><?= $role['id'] ?></div>
    </div>
    <div class="model-no-id">
        <div>
            <div>Название</div>
            <div><?= $role['name'] ?></div>
        </div>
        <div class="model-actions">
            <a href="/roles/show/<?=$role['id']?>">Посмотреть</a>
            <a href="/roles/edit/<?=$role['id']?>">
                Изменить
            </a>
            <a
                    href="/roles/delete/<?= $role['id'] ?>"
                    onclick="return confirm('Вы уверены, что хотите удалить эту роль?')">
                Удалить
            </a>
        </div>
    </div>
</div>
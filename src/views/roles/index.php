<div class="models">
    <div class="model-header">
        <div class="model-title">Роли пользователей</div>
        <a href="roles/create">Добавить роль</a>
    </div>
    <div class="model-block">
        <?php foreach ($roles as $role): ?>
            <div class="single-model">
                <div class="model-id">
                    <div>id</div>
                    <div><?= $role['id'] ?></div>
                </div>
                <div class="model-no-id">
                    <div>
                        <div class="dev">Название</div>
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
        <?php endforeach; ?>
    </div>
</div>
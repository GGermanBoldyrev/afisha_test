<div class="models">
    <div class="model-header">
        <div class="model-title">Список пользователей</div>
        <a href="users/create">Добавить пользователя</a>
    </div>
    <div class="model-block">
        <?php foreach ($users as $user): ?>
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
                        <?php if (!empty($userRoles[$user['id']])): ?>
                            <div>
                                <?php foreach ($userRoles[$user['id']] as $roleName): ?>
                                    <div class="role-name">- <?= $roleName ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>У этого пользователя нет ролей.</p>
                        <?php endif; ?>
                    </div>
                    <div class="model-actions">
                        <a href="/users/show/<?=$user['id']?>">Посмотреть</a>
                        <a href="/users/edit/<?=$user['id']?>">Изменить</a>
                        <a
                            href="/users/delete/<?= $user['id'] ?>"
                            onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                            Удалить
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
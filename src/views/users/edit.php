<div class="models">
    <div class="model-header">
        <div class="model-title">Редактирование пользователя</div>
    </div>
    <form action="/users/update/<?= $user['id'] ?>" method="POST">
        <div class="model-create">
            <div class="model-create-title">Новое имя пользователя</div>
            <label>
                <input type="text" name="name" value="<?= $user['name'] ?>">
            </label>
            <div class="model-create-title">Новый email пользователя</div>
            <label>
                <input type="text" name="email" value="<?= $user['email'] ?>">
            </label>
            <?php foreach ($roles as $role): ?>
                <div class="role-option">
                    <div class="role-option-checkbox">
                        <input
                                type="checkbox"
                                name="role_ids[]"
                                value="<?= $role['id'] ?>"
                            <?php if (in_array($role['id'], array_column($userRoles, 'id'))): ?> checked <?php endif; ?>
                        >
                    </div>
                    <div><?= $role['name'] ?></div>
                </div>
            <?php endforeach; ?>
            <button type="submit" id="user-create-btn">Изменить</button>
        </div>
    </form>
</div>
<div class="models">
    <div class="model-header">
        <div class="model-title">Добавление нового пользователя</div>
    </div>
    <form action="/users" method="POST">
        <div class="model-create">
            <div class="model-create-title">Название пользователя</div>
            <label>
                <input type="text" name="name">
            </label>
            <div class="model-create-title">Email пользователя</div>
            <label>
                <input type="email" name="email">
            </label>
            <div class="model-create-title">Роли пользователя</div>
            <?php foreach ($roles as $role): ?>
                <div class="role-option">
                    <div class="role-option-checkbox">
                        <input type="checkbox" name="role_ids[]" value="<?= $role['id'] ?>" class="b">
                    </div>
                    <div><?= $role['name'] ?></div>
                </div>
            <?php endforeach; ?>
            <button type="submit" id="user-create-btn">Создать</button>
        </div>
    </form>
</div>
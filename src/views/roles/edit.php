<div class="models">
    <div class="model-header">
        <div class="model-title">Редактирование роли</div>
    </div>
    <form action="/roles/update/<?=$role['id']?>" method="POST">
        <div class="model-create">
            <div class="model-create-title">Новое название роли</div>
            <label>
                <input type="text" name="name" value="<?=$role['name']?>">
            </label>
            <button type="submit">Изменить</button>
        </div>
    </form>
</div>
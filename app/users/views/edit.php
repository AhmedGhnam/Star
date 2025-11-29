<h1>Edit User</h1>
<form method="POST" action="/star/users/update/<?= $user->getId(); ?>">
    <input type="text" name="username" value="<?= htmlspecialchars($old['username'] ?? $user->userName); ?>" >    
    <?php if(!empty($errors['username'])): ?>
        <ul>
            <?php foreach($errors['username'] as $error): ?>
                <li style="color: red"><?= $error ?></li>
            <?php endforeach; ?>    
        </ul>
    <?php endif; ?>
    <button type="submit">Update</button>
</form>
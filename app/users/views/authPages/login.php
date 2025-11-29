<h1>LogIN</h1>
<form action="/star/login" method="POST">
    <input type="text" name="username" placeholder="Username" value="<?= $old['username'] ?? '' ?>">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">LogIn</button>
</form>

<?php if(!empty($errors)): ?>

    <ul>
        <?php foreach($errors as $error):?>
            <li>
                <?= $error ?>
            </li>
        <?php endforeach; ?>    
    </ul>

<?php endif; ?>
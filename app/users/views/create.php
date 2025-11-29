<h1>Create User Form</h1>
<form method="POST" action="/star/users/store" enctype="multipart/form-data">

    <input type="text" placeholder="Name" name="username" value="<?=htmlspecialchars($old['username'] ?? '') ?>">
    <input type="file" name="profile_picture" accept="image/*">
    <?php if(!empty($errors['username'])): ?>
             <ul>   
                <?php foreach($errors['username'] as $error): ?>
                    <li style="color: red"><?= $error ?></li>
                <?php endforeach?>
            </ul>   
    <?php endif; ?>   

    <button type="submit">Save</button>
    <?php if(!empty($msg)): ?>
        <p style="color: green; font-weight: bold"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>    

</form>
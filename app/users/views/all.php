<h1>Users List</h1>
<style>
    .users-table {
        border-collapse: collapse;
        width: 100%;
    }
    .users-table th, .users-table td {
        border: 1px solid #000;
        padding: 5px;
    }
</style>
<form method="GET" action="/star/users/search">
    <input type="text" name="s" value="<?= isset($search) ? $search : "" ?>" />
    <button type="submit">Search</button>
</form>
<table class="users-table">
    <tr>
        <th><a href="?s=<?= urlencode($search) ?>&order=id&sort=<?= $sort === 'ASC' ? 'DESC' : 'ASC' ?>">ID</a></th>
        <th><a href="?s=<?= urlencode($search) ?>&order=user_name&sort=<?= $sort === 'ASC' ? 'DESC' : 'ASC' ?>">User Name</a></th>
        <th>Group</th>
        <th><a href="?s=<?= urlencode($search) ?>&order=date&sort=<?= $sort === 'ASC' ? 'DESC' : 'ASC' ?>">Date</a></th>
        <th>Actions</th>
    </tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= htmlspecialchars($user->userName) ?></td>
            <td><?= $user->userRole === 'user' ? 'user' : 'admin' ?></td>
            <td><?= $user->date ?></td>
            <td>
                <a href="/star/users/edit/<?= $user->id ?>">Edit</a>
                <a href="/star/users/delete/<?= $user->id ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>    
</table>
<!-- Pagination -->
<div style="margin-top: 20px;">
    <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="/star/users<?php
                 if(isset($search) && $search !== '') {
                    echo '/search?s=' . urlencode($search) . '&page=';
                 } else {
                    echo '?page=';
                 }
                ?><?= $i ?>" <?= ($i == $page) ? 'style="font-weight : bold"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
</div>
<a href="<?= BASE_PATH ?>/users/create">Create New User</a>


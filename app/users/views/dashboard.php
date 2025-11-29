<style>

    .container {
        width: 80%;
        margin: auto;
        text-align: center;
    }
    .box-cont {
        display: flex;
        justify-content: space-between;
    }
    .box-cont .box {
        width: 45%;
        padding: 10px;
        background-color: #eee;
        border: 1px solid #aaa;
    }

    .box .box-head {
        font-size:
    }

    .box ul {
        list-style: none;
    }

    .box ul li {
        text-align: left;
        padding: 3px;
    }
    
</style>
<h1 style="text-align: center">Dash Board</h1>
<div class="container">
    <div class="box-cont">
        <div class="box total">
            <h2 class="box-head">Total Users</h2>
            <span><?= $totalUsers ?></span>
        </div>
        <div class="box latest">
            <h2 class="box-head">Latest Users</h2>
            <ul>
                <?php foreach($latestUsers as $user) : ?>
                    <li><?= $user->userName?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

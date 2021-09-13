<?php foreach($users as $user){ ?>
    <?= $user->login ?><br>
    <?= $user->customer->firstname ?><br>
<?php } ?>
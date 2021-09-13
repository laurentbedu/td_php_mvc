<?php foreach($customers as $customer){ ?>
    <?= $customer->firstname ?><br>
    <?= $customer->user ? $customer->user->login : 'No user' ?><br>
<?php } ?>
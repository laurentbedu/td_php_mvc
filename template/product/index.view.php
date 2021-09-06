<h1>
    Liste des produits
</h1>
<ul>
    <?php 
        foreach ($products as $product) {
    ?>
        <li>
            <?= $product->name ?>
        </li>
    <?php
        }
    ?>
</ul>
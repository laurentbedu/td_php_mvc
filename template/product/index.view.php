<h1>
    Liste des produits
</h1>
<ul>
    <?php 
        foreach ($products as $product) {
    ?>
        <li>
            <a href="/product/read/<?= $product->id?>"><?= $product->name ?></a>
            <span> (<?= $product->category->name ?>) </span>
        </li>
    <?php
        }
    ?>
</ul>
<h1>
Détail de la catégorie : <?= $category->name ?>
</h1>
<h2>
Produits de cette catégorie :
</h2>
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
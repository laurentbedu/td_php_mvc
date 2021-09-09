<h1 class="d-inline">
    Liste des produits
</h1>
<a href="product/create" class="btn btn-sm btn-success mb-3">Nouveau Produit</a>
<ul>
    <?php 
        foreach ($products as $product) {
    ?>
        <li>
            <a href="/product/read/<?= $product->id?>"><?= $product->name ?></a>
            <span> (<?= $product->category->name ?? 'Aucune' ?>) </span>
        </li>
    <?php
        }
    ?>
</ul>
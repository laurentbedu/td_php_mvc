<h1>
Détail du produit : <?= $product->name ?>
</h1>
<h2>
Catégorie du produit : <?= $product->category->name ?? 'Aucune' ?>
</h2>
<h4>
Description : <?= $product->description ?>
</h4>
<h4>
Prix : <?= $product->price ?>
</h4>
<div>
    <img alt="<?= $product->name ?>" src="<?= $product->image_path ?? '' ?>" />
</div>
<br>
<a href="/product/update/<?= $product->id?>" class="btn btn-sm btn-success mb-3">
    Modifier
</a>
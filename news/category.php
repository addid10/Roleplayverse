<div class="widget-item">
    <form action="search" class="search-form">
        <input type="text" name="q">
        <button class="search-btn"><i class="fa fa-search"></i></button>
    </form>
</div>
<div class="widget-item">
    <h2 class="widget-title">Categories</h2>
    <ul>
        <?php require_once('category.list.php') ?>
        <?php foreach($list as $data): ?>
        <li><a href="../category/<?= strtolower($data->category_name) ?>"><?= $data->category_name ?></a></li>
        <?php endforeach ?>
    </ul>
</div>
<div class="widget-item">
    <h2 class="widget-title">Featured Affiliation</h2>
    <a class="d-block" href="https://www.roleplayverse.site/affiliation/2345"><img src="../ovakun/aovchan/aman/theelite.png" width="100%"></a>
</div>
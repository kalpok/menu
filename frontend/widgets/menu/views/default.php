<p>I'm supposed to get overwritten :)</p>
<p>btw here is list of my items:</p>
<ul>
    <?php foreach ($menu->children()->all() as $item) : ?>
        <li><?= $item->title ?></li>
    <?php endforeach ?>
</ul>

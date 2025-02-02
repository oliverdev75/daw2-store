<article class="p-5 grid gap-y-4 rounded-lg container-shadow">
    <div class="flex justify-center items-center">
        <img class="w-50 max-h-48" src="<?= $image ?>" alt="Ceviche">
    </div>
    <div class="grid gap-y-6">
        <div class="flex flex-col gap-y-2">
            <span><?= $category ?></span>
            <span class="text-2xl font-bold"><?= $name ?></span>
        </div>
        <span class="text-xl"><?= $price ?>€</span>
        <div class="justify-self-end w-full grid gap-y-2">
            <a class="btn btn-tertiary btn-full" role="button" href="<?= $this->route('product.show', compact('id')) ?>">Details</a>
            <form action="<?= $this->route('cart.addproduct') ?>" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button class="btn btn-secondary btn-full" type="submit">Add to cart</button>
            </form>
        </div>
    </div>
</article>
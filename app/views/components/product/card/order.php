<article class="px-10 py-5 grid grid-cols-[1fr_4fr] sm:grid-flow-col auto-cols-max border-b border-neutral-400 gap-x-5">
    <div class="h-full">
        <img src="<?= $this->image('home.ceviche') ?>" alt="<?= $product->getName() ?> image">
    </div>
    <div class="col-start-2 w-full grid sm:grid-cols-2 auto-rows-max">
        <h2 class="text-2xl self-center"><?= $product->getName() ?></h2>
        <div class="w-full h-20 col-start-2 grid grid-flow-col justify-end">
            <div class="h-8 flex items-start gap-x-3">
                <?php if($type == 'cart'): ?>
                    <input
                        id="product-<?= $product->getId() ?>"
                        class="product-quantity-input input-text-quant h-full font-bold"
                        type="text" name=":<?= $product->getId() ?>"
                        value="<?= $product->getQuantity() ?>"
                    >
                    <form class="h-full" action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $product->getId() ?>">
                        <button class="btn-icon btn-red h-fit" type="submit">
                            <i class="bi bi-trash text-[1.125rem] leading-[0] text-white"></i>
                        </button>
                    </form>
                <?php else: ?>
                    <div class="px-5 py-px flex justify-center text-center font-bold">
                        x<?= $productQuantity ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <?php if($type == 'cart'): ?>
            <form id="<?= $product->getId() ?>" class="quantities-form w-full row-start-2 col-span-2 grid gap-y-5" action="<?= $this->route('cart.updateproduct') ?>" method="post">
                <ul class="w-full list-none ingredients-list gap-7">
                    <?php foreach($ingredients as $ingredientId => $ingredient): ?>
                        <?php if(intval(explode('-', $ingredientId)[0]) == $product->getId()): ?>
                            <li class="grid grid-cols-2 items-center gap-x-4">
                                <img class="w-16 object-fit" src="<?= $ingredient->getImage() ?>" alt="<?= $ingredient->getName() ?> image">
                                <input
                                    class="ingredient-<?= $product->getId() ?> input-text-quant w-10 h-7 font-bold"
                                    type="text"
                                    name="<?= $ingredientId ?>"
                                    value="<?= $ingredient->getQuantity() ?>"
                                >
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
                <button class="btn btn-secondary text-[.8rem] justify-self-end" type="submit">Update</button>
            </form>
        <?php else: ?>
            <div class="w-full row-start-2 col-span-2">
                <ul class="w-full list-none ingredients-list gap-7">
                    <?php foreach($ingredients as $ingredient): ?>
                        <li class="grid grid-flow-col auto-cols-max items-center gap-x-4">
                            <img class="w-12 h-12 object-contain" src="<?= $ingredient->getImage() ?>" alt="<?= $ingredient->getName() ?> image">
                            <div class="py-px flex justify-center text-center font-bold">
                                <?= $ingredient->getQuantity() ?>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    </div>
</article>
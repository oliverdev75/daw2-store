<article class="px-10 py-5 border border-solid border-neutral-300 grid  grid-cols-1 sm:grid-cols-[1fr_4fr] min-[1100px]:grid-cols-[2fr_3fr] min-[1200px]:grid-flow-col gap-x-5">
    <div class="flex justify-center sm:block h-full">
        <img src="<?= $this->image('home.ceviche') ?>" alt="<?= $product->getName() ?> image">
    </div>
    <div class="mt-5 min-[460px]:m-0 row-start-2 sm:row-start-1 sm:col-start-2 w-full grid grid-cols-1 auto-cols-max justify-between grid-flow-col auto-rows-max justify-center min-[460px]:justify-start gap-y-7 min-[460px]:gap-y-5 min-[476px]:gap-0">
        <h2 class="text-2xl self-center text-center min-[460px]:text-start"><?= $product->getName() ?></h2>
        <div class="w-full h-10 min-[460px]:h-20 row-start-2 min-[460px]:row-start-1 min-[460px]:col-start-2 grid grid-flow-col justify-center min-[460px]:justify-end items-center xl:items-start">
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
                        <button class="btn-icon btn-danger h-fit" type="submit">
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
            <form id="<?= $product->getId() ?>" class="quantities-form w-full row-start-3 min-[460px]:row-start-2 col-span-2 grid gap-y-5" action="<?= $this->route('cart.updateproduct') ?>" method="post">
                <ul class="w-full list-none ingredients-list gap-7">
                    <?php foreach($ingredients as $ingredientId => $ingredient): ?>
                        <?php if(intval(explode('-', $ingredientId)[0]) == $product->getId()): ?>
                            <li class="w-fit min-[460px]:w-full grid grid-cols-2 justify-items-center min-[460px]:justify-items-start items-center gap-x-4">
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
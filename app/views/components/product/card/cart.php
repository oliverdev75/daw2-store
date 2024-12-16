<article class="px-10 py-5 grid grid-cols-[1fr_4fr] sm:grid-flow-col auto-cols-max border-b border-neutral-400 gap-x-5">
    <div class="h-full">
        <img src="<?= $this->image($image) ?>" alt="<?= $name ?> image">
    </div>
    <div class="col-start-2 w-full grid sm:grid-cols-2 auto-rows-max">
        <h2 class="text-2xl self-center"><?= $name ?></h2>
        <div class="w-full h-20 col-start-2 grid grid-flow-col justify-end">
            <div class="h-8 flex items-start gap-x-3">
                <input class="input-text-quant h-full font-bold" type="text" name="<?= $id ?>" value="1">
                <form class="h-full" action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button class="btn-icon btn-red h-fit" type="submit">
                        <i class="bi bi-trash text-[1.125rem] leading-[0] text-white"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="w-full row-start-2 col-span-2">
            <ul class="list-none grid grid-flow-col auto-cols-max gap-5">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <li class="h-9 w-fit flex items-center gap-x-4">
                        <img class="max-w-8 h-9 object-cover" src="<?= $ingredient['image'] ?>" alt="<?= $i ?>">
                        <input class="input-text-quant w-10 h-7 font-bold" type="text" name="<?= "{$id}-{$ingredient['id']}" ?>">
                    </li>
                <?php endfor ?>
            </ul>
        </div>
    </div>
</article>
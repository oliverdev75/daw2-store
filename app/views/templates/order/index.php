<div class="my-10 grid gap-y-5">
    <a class="site-link" href="<?= $this->route('order.index') ?>">Orders</a>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Orders</h1>
        <form class="h-fit px-5 md:px-3 py-[6px] flex jusitfy-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500" method="get">
            <input class="w-full outline-none" type="date" name="date" required>
            <button>
                <i class="bi bi-search"></i>
            </button>
        </form>
        <div class="grid border-t border-solid border-zinc-500">
                <?php if ($orders): ?>
                    <div class="grid">
                        <?php foreach ($orders as $order): ?>
                            <article class="w-full px-10 py-5 border-b border-solid border-neutral-300">
                                <a class="site-link" href="<?= $this->route('order.show', ['id' => $order->getId()]) ?>">
                                    <h2 class="text-2xl">
                                        <?= $order->getFormattedCreationTime() ?>
                                    </h2>
                                </a>
                            </article>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="w-full h-36 grid place-content-center">
                        <p class="text-center">There're no orders.</p>
                        <p class="text-center font-semibold">Go 
                            <a href="<?= $this->route('product.index') ?>">menu</a>
                             to begin one.
                        </p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
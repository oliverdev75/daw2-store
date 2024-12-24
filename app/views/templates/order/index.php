<div class="my-10 grid gap-y-5">
    <a class="site-link" href="<?= $this->route('order.index') ?>">Orders</a>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Orders</h1>
        <div class="grid border-t border-solid border-zinc-500">
                <?php if ($orders): ?>
                    <div class="grid gap-12">
                        <?php foreach ($orders as $order): ?>
                            <article class="w-full px-10 py-5 border-b border-solid border-neutral-300">
                                <a class="site-link" href="<?= $this->route('order.show', ['id' => $order->getId()]) ?>">
                                    <h2 class="text-2xl">
                                        <?= $order->getCreationTime()['day'] ?>/<?= $order->getCreationTime()['month'] ?>/<?= $order->getCreationTime()['year'] ?> at <?= $order->getCreationTime()['hour'] ?>:<?= $order->getCreationTime()['minute'] ?>
                                    </h2>
                                </a>
                            </article>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="w-full h-full grid place-content-center">
                        <p class="text-neutral-400">There're no orders</p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>





<div class="my-10 grid gap-y-5">
    <div class="flex gap-x-3">
        <a class="site-link" href="<?= $this->route('order.index') ?>">Orders</a>
        <?php if($order): ?>
            <i class="bi bi-chevron-right"></i>
            <a class="site-link" href="<?= $this->route('order.show', ['id' => $order->getId()]) ?>">
                <?= $order->getFormattedCreationTime() ?>
            </a>
        <?php endif ?>
    </div>
    <div class="grid gap-y-7">
        <?php if($message): ?>
            <div class="message message-success">Nice! Order created.</div>
        <?php endif ?>
        <h1 class="text-4xl">Order: <?= $order ? $order->getFormattedCreationTime() : 'does not exist' ?></h1>
        <div class="grid">
                <?php if ($order): ?>
                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-[2fr_1fr] gap-x-20">
                        <section class="row-start-2 sm:row-start-1 grid gap-y-5">
                            <?php if ($principles): ?>
                                <div class="grid gap-y-3">
                                    <h2 class="text-[1.3rem]">Principles</h2>
                                    <div class="grid gap-y-3">
                                        <?php foreach ($principles as $principle): ?>
                                            <?php
                                                $this->component('product.card.order', [
                                                    'product' => $principle->getProduct(),
                                                    'productQuantity' => $principle->getQuantity(),
                                                    'ingredients' => $principle->getProduct()->getMixIngredients(),
                                                    'type' => 'order'
                                                ])
                                            ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ($snacks): ?>
                                <div class="grid gap-y-3">
                                    <h2 class="text-[1.3rem]">Snacks</h2>
                                    <div class="grid gap-y-3">
                                        <?php foreach ($snacks as $snack): ?>
                                            <?php
                                                $this->component('product.card.order', [
                                                    'product' => $snack->getProduct(),
                                                    'productQuantity' => $snack->getQuantity(),
                                                    'ingredients' => $snack->getProduct()->getMixIngredients(),
                                                    'type' => 'order'
                                                ])
                                            ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ($drinks): ?>
                                <div class="grid gap-y-3">
                                    <h2 class="text-[1.3rem]">Drinks</h2>
                                    <div class="grid gap-y-3">
                                        <?php foreach ($drinks as $drink): ?>
                                            <?php
                                                $this->component('product.card.order', [
                                                    'product' => $drink->getProduct(),
                                                    'productQuantity' => $drink->getQuantity(),
                                                    'ingredients' => $drink->getProduct()->getMixIngredients(),
                                                    'type' => 'order'
                                                ])
                                            ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ($desserts): ?>
                                <div class="grid gap-y-3">
                                    <h2 class="text-[1.3rem]">Desserts</h2>
                                    <div class="grid gap-y-3">
                                        <?php foreach ($desserts as $dessert): ?>
                                            <?php
                                                $this->component('product.card.order', [
                                                    'product' => $dessert->getProduct(),
                                                    'productQuantity' => $dessert->getQuantity(),
                                                    'ingredients' => $dessert->getProduct()->getMixIngredients(),
                                                    'type' => 'order'
                                                ])
                                            ?>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </section>
                        <section class="row-start-1">
                            <div class="px-5 py-6 rounded-lg shadow-lg grid">
                                <h3 class="mb-4 text-2xl">Total</h3>
                                <div class="mb-3 grid gap-y-2">
                                    <span>Price: <strong id="subtotal"><?= $order->getPrice() ?> €</strong></span>
                                    <span>IVA: <strong id="iva"><?= $order->getIVA() ?> €</strong></span>
                                </div>
                                <div class="grid gap-y-3">
                                    <span class="text-lg">Tota price: <strong id="total"><?= $order->getTotalPrice() ?> €</strong></span>
                                </div>
                            </div>
                        </section>
                <?php else: ?>
                    <div class="w-full h-36 grid place-content-center">
                        <p class="text-center">The order does not exist.</p>
                        <p class="text-center font-semibold">Go back to <a href="<?= $this->route('order.index') ?>">orders</a>.</p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
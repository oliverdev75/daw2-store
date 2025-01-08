<div class="my-10 grid gap-y-5">
    <span>Cart</span>
    <div class="grid gap-y-7">
        <h1 class="text-3xl">Finish your order!</h1>
        <div id="order-error" class="message message-danger" style="display: <?= $error ? 'block' : 'none' ?>;"><?= $error ?? '' ?></div>
        <div class="mt-10 grid grid-cols-1 min-[980px]:grid-cols-[2fr_1fr] gap-x-20">
            <section class="row-start-2 min-[980px]:row-start-1 grid gap-y-5">
                <div class="mt-10 sm:m-0 grid gap-y-3">
                    <h2 class="text-[1.3rem]">Principles</h2>
                    <?php if ($principles): ?>
                        <div class="grid gap-y-3">
                            <?php foreach ($principles as $principle): ?>
                                <?php
                                    $this->component('product.card.order', [
                                        'product' => $principle,
                                        'ingredients' => $ingredients,
                                        'type' => 'cart'
                                    ])
                                ?>
                            <?php endforeach ?>
                        </div>
                    <?php else: ?>
                        <div class="h-32 grid place-content-center">
                            <span class="font-bold text-center">No principles yet.</span>
                            <span class="text-center">
                                You can add some going to
                                <a href="<?= $this->route('product.index', [], ['principles' => 'on']) ?>">menu</a>.
                            </span>
                        </div>
                    <?php endif ?>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Snacks</h2>
                    <?php if ($snacks): ?>
                        <div class="grid gap-y-3">
                            <?php foreach ($snacks as $snack): ?>
                                <?php
                                    $this->component('product.card.order', [
                                        'product' => $snack,
                                        'ingredients' => $ingredients,
                                        'type' => 'cart'
                                    ])
                                ?>
                            <?php endforeach ?>
                        </div>
                    <?php else: ?>
                        <div class="h-32 grid place-content-center">
                            <span class="font-bold text-center">No snacks yet.</span>
                            <span class="text-center">
                                You can add some going to
                                <a href="<?= $this->route('product.index', [], ['snacks' => 'on']) ?>">menu</a>.
                            </span>
                        </div>
                    <?php endif ?>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Drinks</h2>
                    <?php if ($drinks): ?>
                        <div class="grid gap-y-3">
                            <?php foreach ($drinks as $drink): ?>
                                <?php
                                    $this->component('product.card.order', [
                                        'product' => $drink,
                                        'ingredients' => $ingredients,
                                        'type' => 'cart'
                                    ])
                                ?>
                            <?php endforeach ?>
                        </div>
                    <?php else: ?>
                        <div class="h-32 grid place-content-center">
                            <span class="font-bold text-center">No drinks yet.</span>
                            <span class="text-center">
                                You can add some going to
                                <a href="<?= $this->route('product.index', [], ['drinks' => 'on']) ?>">menu</a>.
                            </span>
                        </div>
                    <?php endif ?>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Desserts</h2>
                    <?php if ($desserts): ?>
                        <div class="grid gap-y-3">
                            <?php foreach ($desserts as $dessert): ?>
                                <?php
                                    $this->component('product.card.order', [
                                        'product' => $dessert,
                                        'ingredients' => $ingredients,
                                        'type' => 'cart'
                                    ])
                                ?>
                            <?php endforeach ?>
                        </div>
                    <?php else: ?>
                        <div class="h-32 grid place-content-center">
                            <span class="font-bold text-center">No desserts yet.</span>
                            <span class="text-center">
                                You can add some going to
                                <a href="<?= $this->route('product.index', [], ['desserts' => 'on']) ?>">menu</a>.
                            </span>
                        </div>
                    <?php endif ?>
                </div>
            </section>
            <section class="row-start-1">
                <div class="px-5 py-6 rounded-lg shadow-lg grid">
                    <h3 class="mb-4 text-2xl">Total</h3>
                    <div class="mb-3 grid gap-y-2">
                        <span>Price: <strong id="subtotal"><?= $subtotal ?> €</strong></span>
                        <span>IVA: <strong id="iva"><?= $IVA ?> €</strong></span>
                    </div>
                    <div class="grid gap-y-3">
                        <span class="text-lg">Total price: <strong id="total"><?= $total ?> €</strong></span>
                        <form id="order-form" class="m-0" action="<?= $this->route('order.store') ?>" method="post">
                            <input type="hidden" name="type" value="client">
                            <button class="btn btn-primary w-full" type="submit">Order</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="<?= $this->js('cart.order') ?>"></script>
</div>
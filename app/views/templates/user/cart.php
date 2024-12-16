<div class="my-10 grid gap-y-5">
    <span>Cart</span>
    <div class="grid gap-y-7">
        <h1 class="text-3xl">Finish your order!</h1>
        <div id="order-error" class="hidden message message-danger"></div>
        <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr] gap-x-20">
            <section class="row-start-2 sm:row-start-1 grid gap-y-5">
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Principals</h2>
                    <div class="grid gap-y-3">
                        <?php for ($i = 0; $i < 3; $i++): ?>
                            <?php
                                $this->component('product.card.cart', [
                                    'id' => $product->getId(),
                                    'image' => $product->getImage(),
                                    ''
                                ])
                            ?>
                        <?php endfor ?>
                    </div>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Snacks</h2>
                    <div class="grid gap-y-3">
                        <article class="px-10 py-5 grid grid-cols-[1fr_4fr] sm:grid-flow-col auto-cols-max border-b border-neutral-400 gap-x-5">
                            <div class="h-full">
                                <img src="<?= $this->image('home.ceviche') ?>" alt="">
                            </div>
                            <div class="col-start-2 w-full grid sm:grid-cols-2 auto-rows-max">
                                <h2 class="text-2xl self-center">Ceviche</h2>
                                <div class="w-full h-20 col-start-2 grid grid-flow-col justify-end">
                                    <div class="h-8 flex items-start gap-x-3">
                                        <input class="input-text-quant h-full font-bold" type="text" name="">
                                        <form class="h-full" action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                                            <input type="hidden" name="id" value="1">
                                            <button class="btn-icon btn-red h-fit" type="submit">
                                                <i class="bi bi-trash text-[1.125rem] leading-[0] text-white"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="w-full row-start-2 col-span-2">
                                    <ul class="list-none grid grid-flow-col auto-cols-max gap-5">
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="1234">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="567">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="543as">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Drinks</h2>
                    <div class="grid gap-y-3">
                        <article class="px-10 py-5 grid grid-cols-[1fr_4fr] sm:grid-flow-col auto-cols-max border-b border-neutral-400 gap-x-5">
                            <div class="h-full">
                                <img src="<?= $this->image('home.ceviche') ?>" alt="">
                            </div>
                            <div class="col-start-2 w-full grid sm:grid-cols-2 auto-rows-max">
                                <h2 class="text-2xl self-center">Ceviche</h2>
                                <div class="w-full h-20 col-start-2 grid grid-flow-col justify-end">
                                    <div class="h-8 flex items-start gap-x-3">
                                        <input class="input-text-quant h-full font-bold" type="text" name="">
                                        <form class="h-full" action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                                            <input type="hidden" name="id" value="1">
                                            <button class="btn-icon btn-red h-fit" type="submit">
                                                <i class="bi bi-trash text-[1.125rem] leading-[0] text-white"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="w-full row-start-2 col-span-2">
                                    <ul class="list-none grid grid-flow-col auto-cols-max gap-5">
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="1234">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="567">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="543as">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="grid gap-y-3">
                    <h2 class="text-[1.3rem]">Desserts</h2>
                    <div class="grid gap-y-3">
                        <article class="px-10 py-5 grid grid-cols-[1fr_4fr] sm:grid-flow-col auto-cols-max border-b border-neutral-400 gap-x-5">
                            <div class="h-full">
                                <img src="<?= $this->image('home.ceviche') ?>" alt="">
                            </div>
                            <div class="col-start-2 w-full grid sm:grid-cols-2 auto-rows-max">
                                <h2 class="text-2xl self-center">Ceviche</h2>
                                <div class="w-full h-20 col-start-2 grid grid-flow-col justify-end">
                                    <div class="h-8 flex items-start gap-x-3">
                                        <input class="input-text-quant h-full font-bold" type="text" name="">
                                        <form class="h-full" action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                                            <input type="hidden" name="id" value="1">
                                            <button class="btn-icon btn-red h-fit" type="submit">
                                                <i class="bi bi-trash text-[1.125rem] leading-[0] text-white"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="w-full row-start-2 col-span-2">
                                    <ul class="list-none grid grid-flow-col auto-cols-max gap-5">
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="1234">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="567">
                                        </li>
                                        <li class="h-9 w-fit flex items-center gap-x-4">
                                            <img class="w-8 h-9 object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant w-10 h-7 font-bold" type="text" name="543as">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
            <section class="row-start-1">
                <div class="px-5 py-6 rounded-lg shadow-lg grid">
                    <h3 class="mb-4 text-2xl">Total</h3>
                    <div class="mb-3 grid gap-y-2">
                        <span>Price: <strong>10,00€</strong></span>
                        <span>IVA: <strong>6,40€</strong></span>
                    </div>
                    <div class="grid gap-y-3">
                        <span class="text-lg">Tota price: <strong>36,60€</strong></span>
                        <form id="order-form" action="<?= $this->route('cart.order') ?>" method="post">
                            <button class="btn btn-primary w-full" type="submit">Order</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="<?= $this->js('cart.order') ?>"></script>
</div>
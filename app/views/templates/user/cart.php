<div class="my-10 grid gap-y-5">
    <span>Cart</span>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Finish your order!</h1>
        <form action="<?= $this->route('cart.order') ?>" method="post">
            <div class="grid grid-cols-1 sm:grid-cols-[3fr_1fr] gap-x-28">
                <section class="row-start-2 sm:row-start-1 grid gap-y-3">
                    <h2 class="text-[1.3rem]">Principals</h2>
                    <div class="grid gap-y-3">
                        <article class="grid grid-cols-1 sm:grid-cols-5 sm:grid-flow-col border-b border-neutral-400">
                            <div class="h-full">
                                <img src="<?= $this->image('home.ceviche') ?>" alt="">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-rows-2 sm:grid-cols-2">
                                <h2 class="text-2xl">Ceviche</h2>
                                <div class="col-start-2 grid grid-flow-col">
                                    <div class="grid justify-items-center">
                                        <input class="input-text-quant" type="text">
                                        <form action="<?= $this->route('cart.deleteproduct') ?>" method="post">
                                            <input type="hidden" name="id" value="1">
                                            <button class="btn-icon btn-red" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="row-start-2 col-span-2">
                                    <ul class="list-none grid gap-5">
                                        <li>
                                            <img class="object-cover" src="<?= $this->image('ingredients.lime') ?>" width="90" height="90" alt="">
                                            <input class="input-text-quant" type="text">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
                <section class="row-start-1">
                    <div class="px-5 py-6 rounded-lg shadow-lg grid">
                        <h3 class="mb-4 text-3xl">Total</h3>
                        <div class="mb-3 grid gap-y-2">
                            <span>Price: <strong>10,00€</strong></span>
                            <span>IVA: <strong>6,40€</strong></span>
                        </div>
                        <div class="grid gap-y-3">
                            <span class="text-lg">Tota price: <strong>36,60€</strong></span>
                            <button class="btn btn-primary w-full" type="submit">Order</button>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </div>
</div>
<div class="my-10 grid gap-y-5">
    <span>Menu</span>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Menu</h1>
        <div class="px-6 py-4 bg-neutral-100 border border-solid border-neutral-300 text-lg rounded-md">
            See your last <a href="<?= $this->route('order.show', ['id' => $lastOrder]) ?>">order</a>.
        </div>
        <?php if(!is_null($error)): ?>
            <div class="message message-info">This product is already in cart, go <a href="<?= $this->route('cart.index') ?>">there</a> to increment its quantity.</div>
        <?php endif ?>
        <div class="grid min-[1120px]:grid-cols-5 md:gap-x-16">
            <?php $this->component('menu.filter') ?>
            <div class="min-[1120px]:col-span-4 grid min-[1120px]:grid-cols-1 gap-y-16">
                <form id="menu-filter-form" method="get" action="<?= $this->route('product.index') ?>">
                    <div class="grid grid-rows-4 sm:grid-rows-2 grid-cols-1 sm:grid-cols-2 justify-items-center sm:justify-items-start gap-y-2 sm:gap-y-4">
                        <div class="row-span-2 sm:row-span-1 sm:col-span-2 w-full grid grid-rows-2 sm:grid-rows-1 grid-cols-1 sm:grid-cols-2 sm:grid-flow-col justify-items-center sm:justify-items-start items-center gap-y-2 sm:gap-y-4 sm:gap-x-3">
                            <div class="sm:col-span-2 w-full h-fit px-5 sm:px-3 py-[6px] flex gap-2 sm:gap-0 justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
                                <input class="w-full focus:outline-none" type="text" name="product_name" placeholder="Search by product name..." value="<?= $defaultValue ?>">
                                <button class="md:px-3 lg:px-0" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            <a class="btn btn-secondary w-full sm:w-fit" href="<?= $this->route('product.index') ?>" role="button">Reset</a>
                        </div>
                        <div class="row-start-3 sm:row-start-2 min-[1120px]:col-start-2 sm:justify-self-end flex items-center gap-3">
                            <div>
                                <label for="results-order">Order by</label>
                                <select class="px-5 py-3 md:px-3 md:py-2 rounded" name="order" id="results-order">
                                    <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="name" selected>Name</option>
                                    <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="price">Price</option>
                                    <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="">None</option>
                                </select>
                            </div>
                            <select class="px-5 py-3 md:px-3 md:py-2 rounded" name="order_type">
                                <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="asc" selected>Ascendant</option>
                                <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="desc">Descendant</option>
                            </select>
                        </div>
                        <label class="row-start-4 sm:row-start-2 col-start-1 justify-self-start btn btn-secondary block min-[1120px]:hidden w-full sm:w-fit flex justify-center items-center gap-3" for="menu-filter-btn" role="button" aria-label="Toggle products filter">
                            <span class="text-white">Filter</span>
                            <i class="bi bi-sliders text-white text-lg"></i>
                        </label>
                        <?php $this->component('side_hidden_panel.open', ['id' => 'menu-filter-btn']) ?>
                            <div class="side-menu-filter grid gap-y-5">
                                <h2 class="text-2xl">Filter</h2>
                                <div class="flex flex-col gap-y-3">
                                    <h3>Categories</h3>
                                    <div class="ms-2 flex flex-col gap-y-3">
                                        <?php
                                        $this->component('form.checkbox', [
                                            'id' => 'side-principles',
                                            'name' => 'principles',
                                            'label' => 'Principles',
                                        ])
                                        ?>
                                        <?php
                                        $this->component('form.checkbox', [
                                            'id' => 'side-snacks',
                                            'name' => 'snacks',
                                            'label' => 'Snacks'
                                        ])
                                        ?>
                                        <?php
                                        $this->component('form.checkbox', [
                                            'id' => 'side-drinks',
                                            'name' => 'drinks',
                                            'label' => 'Drinks'
                                        ])
                                        ?>
                                        <?php
                                        $this->component('form.checkbox', [
                                            'id' => 'side-desserts',
                                            'name' => 'desserts',
                                            'label' => 'Desserts'
                                        ])
                                        ?>
                                    </div>
                                </div>
                                <button class="filter-apply-btn hidden justify-self-center btn btn-secondary" type="submit">Apply</button>
                            </div>
                        <?php $this->component('side_hidden_panel.close') ?>
                    </div>
                </form>
                <?php if ($products): ?>
                    <div class="grid products-list-layout gap-12">
                        <?php foreach ($products as $product): ?>
                            <?php
                            $this->component('product.card.menu', [
                                'id' => $product->id,
                                'name' => $product->name,
                                'category' => 'Principle',
                                'price' => $product->getPrice()
                            ])
                            ?>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="w-full h-full grid place-content-center">
                        <p class="text-neutral-400">There're no products</p>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
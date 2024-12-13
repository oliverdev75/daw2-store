<div class="my-10 grid gap-y-5">
    <span>Menu</span>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Menu</h1>
        <div class="grid min-[1120px]:grid-cols-5 md:gap-x-16">
            <?php $this->component('menu.filter') ?>
            <div class="min-[1120px]:col-span-4 grid min-[1120px]:grid-cols-1 gap-y-16">
                <form method="get" action="<?= $this->route('product.index') ?>">
                    <div class="grid grid-rows-3 sm:grid-rows-2 grid-cols-1 sm:grid-cols-2 justify-items-center sm:justify-items-start gap-y-2 sm:gap-y-4">
                        <div class="sm:col-span-2 w-full h-fit px-5 sm:px-3 py-[6px] flex gap-2 sm:gap-0 justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
                            <input class="w-full focus:outline-none" type="text" name="product_name" placeholder="Search by product name..." value="<?= $defaultValue ?>">
                            <button class="md:px-3" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div class="row-start-2 sm:row-start-2 min-[1120px]:col-start-2 sm:justify-self-end flex items-center gap-3">
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
                        <label class="row-start-3 sm:row-start-2 col-start-1 justify-self-start btn btn-secondary block min-[1120px]:hidden w-full sm:w-fit flex justify-center items-center gap-3" for="menu-filter-btn" role="button" aria-label="Toggle products filter">
                            <span class="text-white">Filter</span>
                            <i class="bi bi-sliders text-white text-lg"></i>
                        </label>
                        <?php $this->component('side_hidden_panel.open', ['id' => 'menu-filter-btn']) ?>
                        <form class="grid gap-y-5" method="get">
                            <h2 class="text-2xl">Filter</h2>
                            <div class="flex flex-col gap-y-3">
                                <h3>Categories</h3>
                                <div class="ms-2 flex flex-col gap-y-3">
                                    <?php
                                    $this->component('form.checkbox', [
                                        'id' => 'principles',
                                        'inputType' => 'checkbox',
                                        'name' => 'principles',
                                        'label' => 'Principles',
                                    ])
                                    ?>
                                    <?php
                                    $this->component('form.checkbox', [
                                        'id' => 'snacks',
                                        'inputType' => 'checkbox',
                                        'name' => 'snacks',
                                        'label' => 'Snacks'
                                    ])
                                    ?>
                                    <?php
                                    $this->component('form.checkbox', [
                                        'id' => 'desserts',
                                        'inputType' => 'checkbox',
                                        'name' => 'desserts',
                                        'label' => 'Desserts'
                                    ])
                                    ?>
                                </div>
                            </div>
                            <button id="filter-apply-btn" class="hidden justify-self-center btn btn-secondary" type="submit">Apply</button>
                        </form>
                        <?php $this->component('side_hidden_panel.close') ?>
                    </div>
                </form>
                <?php if ($products): ?>
                    <div class="grid products-list-layout gap-12">
                        <?php foreach ($products as $product): ?>
                            <?php
                            $this->component('product.card', [
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
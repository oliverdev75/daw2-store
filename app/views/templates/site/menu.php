<div class="my-10 grid gap-y-5">
    <span>Menu</span>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Menu</h1>
        <div class="grid min-[1120px]:grid-cols-5 md:gap-x-16">
            <?php $this->component('menu.filter') ?>
            <div class="min-[1120px]:col-span-4 grid min-[1120px]:grid-cols-1 gap-y-16">
                <?php
                    $this->component('searchbar.filter', [
                        'formEndpoint' => $this->route('menu'),
                        'options' => [
                            'Cheapest' => 'cheapest',
                            'Expensive' => 'expensive'
                        ]
                    ])
                ?>
                <div class="grid products-list-layout gap-12">
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                    <?php $this->component('product.card') ?>
                </div>
            </div>
        </div>
    </div>
</div>
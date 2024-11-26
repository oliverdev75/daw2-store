<div class="my-10 grid gap-y-5">
    <span>Menu</span>
    <div class="grid gap-y-7">
        <h1 class="text-4xl">Menu</h1>
        <div class="grid md:grid-cols-5 md:gap-x-16">
            <?php $this->component('menu.filter') ?>
            <div class="col-span-4 grid grid-cols-1 md:gap-y-16">
                <?php $this->component('searchbar') ?>
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
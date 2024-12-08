<footer class="w-full px-20 pt-16 pb-10 grid grid-rows-4 md:grid-rows-3 grid-cols-1 lg:grid-cols-2 auto-rows-max auto-cols-max lg:gap-x-10 gap-y-3">
    <div class="row-span-2 md:row-span-1 lg:row-span-2 w-full pb-5 min-[1024px]:px-16 min-[1506px]:px-32 grid grid-cols-1 md:grid-cols-2 md:auto-cols-max justify-center justify-items-center md:gap-x-6">
        <ul class="w-fit grid justify-items-center md:justify-items-start auto-rows-max auto-cols-max gap-y-4 md:gap-y-2">
            <li><a href="/">Home</a></li>
            <li><a href="<?= $this->route('product.index') ?>">Menu</a></li>
            <li><a href="<?= $this->route('offers') ?>">Offers</a></li>
            <li><a href="<?= $this->route('site.aboutus') ?>">About us</a></li>
        </ul>
        <ul class="w-fit grid justify-items-center md:justify-items-start auto-rows-max auto-cols-max gap-y-4 md:gap-y-2">
            <li><a href="<?= $this->route('site.terms_conds') ?>">Terms and conditions</a></li>
            <li><a href="<?= $this->route('site.privacy_policy') ?>">Privacy policy</a></li>
        </ul>
    </div>
    <div class="row-start-3 md:row-start-2 lg:row-span-2 lg:col-start-2 w-full h-fit py-3 md:p-0 grid justify-center lg:justify-end content-center justify-items-center lg:justify-items-end gap-5 lg:gap-3">
        <a class="w-fit flex gap-x-3 items-center" href="">
            <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
            <spa class="text-xl font-bold hidden md:inline">SymfonyRestaurant</span>
        </a>
        <a class="btn btn-secondary text-md lg:text-lg font-bold" role="button" href="<?= $this->route('site.contact') ?>" title="Contact us">Contact us</a>
    </div>
    <small class="col-span-2 justify-self-center self-center text-center">&copy; SymfonyRestaurant 2024 All rights reserved</small>
</footer>
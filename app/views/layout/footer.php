<footer class="w-full px-20 py-5 grid grid-rows-3 lg:grid-rows-2 grid-cols-1 lg:grid-cols-2 auto-rows-max auto-cols-max gap-x-10 gap-y-3">
    <div class="w-full flex justify-center gap-6">
        <ul class="flex flex-col gap-2">
            <li>Home</li>
            <li>Menu</li>
            <li>Offers</li>
            <li>About us</li>
            <li>Contact us</li>
        </ul>
        <ul class="flex flex-col gap-2">
            <li>Terms and conditions</li>
            <li>Privacy policy</li>
        </ul>
    </div>
    <div class="row-start-2 lg:row-start-1 lg:col-start-2 w-full grid justify-center lg:justify-end content-center justify-items-center lg:justify-items-end gap-5 lg:gap-3">
        <a class="w-fit flex gap-x-3 items-center" href="">
            <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
            <spa class="text-xl font-bold hidden lg:inline">SymfonyRestaurant</span>
        </a>
        <a class="btn btn-secondary text-md lg:text-lg font-bold" role="button" href="">Contact us</a>
    </div>
    <small class="justify-self-center self-center col-span-2 h-fit">&copy; SymfonyRestaurant 2024 All rights reserved</small>
</footer>

<footer class="w-full px-6 py-5 grid grid-cols-1 lg:grid-cols-2 gap-x-10 gap-y-3">
    <div class="w-full flex justify-center ">
        <ul>
            <li>Home</li>
            <li>Menu</li>
            <li>Offers</li>
            <li>About us</li>
            <li>Contact us</li>
        </ul>
        <ul>
            <li>Terms and conditions</li>
            <li>Privacy policy</li>
        </ul>
    </div>
    <div class="w-full flex justify-end">
        <a class="w-fit flex gap-x-3 items-center" href="">
            <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
            <spa class="text-xl font-bold hidden lg:inline">SymfonyRestaurant</span>
        </a>
        <a class="btn btn-secondary text-lg" role="button" href="">Contact us</a>
    </div>
    <small class="justify-self-center col-span-2">&copy; SymfonyRestaurant 2024 All rights reserved</small>
</footer>

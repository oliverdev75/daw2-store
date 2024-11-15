<header class="w-full py-5 px-6 lg:px-10">
    <nav class="w-full">
        <div class="grid grid-cols-2 grid-flow auto-cols-min justify-around items-center w-full">
            <a class="flex gap-x-3 items-center w-fit text-lg" href="">
                <img src="<?= $this->image('logo') ?>" class="w-16 h-16" alt="SymfonyRestaurant logo">
                <span class="hidden lg:inline text-2xl font-bold">SymfonyRestaurant</span>
            </a>
            <label for="header-nav-toggler-button" class="inline-block lg:hidden justify-self-end w-fit" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-3xl"></i>
            </label>
            <input id="header-nav-toggler-button" class="hidden" type="checkbox">
            <div id="header-nav" class="absolute h-full w-60 top-0 z-50 p-5 bg-white shadow-md lg:static lg:grid lg:justify-end lg:shadow-none lg:h-fit lg:w-full lg:z-auto">
                <div class="w-full grid place-content-end lg:hidden">
                    <label for="header-nav-toggler-button" class="text-3xl">
                        <i class="fa-solid fa-xmark"></i>
                    </label>
                </div>
                <ul class="grid auto-cols-max gap-y-5 lg:grid-flow-col items-center w-fit">
                    <li class="w-fit px-3">
                        <a class="font-bold" href="#">Home</a>
                    </li>
                    <li class="w-fit px-3">
                        <a class="font-bold" href="#">Menu</a>
                    </li>
                    <li class="w-fit px-3">
                        <a class="font-bold" href="#">Offers</a>
                    </li>
                    <li class="w-fit px-3">
                        <a class="font-bold" href="#">About us</a>
                    </li>
                    <li class="w-fit px-3">
                        <a class="font-bold" href="#">Log in</a>
                    </li>
                    <li class="w-fit px-3">
                        <a class="btn btn-primary font-bold" href="#" role="button">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
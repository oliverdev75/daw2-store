
<header class="w-full px-7 py-5 shadow-lg">
    <nav class="w-full grid grid-flow-col justify-between items-center overflow-hidden">
        <a class="w-fit flex gap-x-3 items-center" href="/">
            <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
            <span class="text-xl font-bold hidden md:inline">SymfonyRestaurant</span>
        </a>
        <label class="lg:hidden" for="header-nav-toggler-button" aria-label="Toggle navigation">
            <span class="fas fa-bars text-2xl"></span>
        </label>
        <input id="header-nav-toggler-button" class="hidden" type="checkbox">
        <div id="header-nav" class="h-full w-60 lg:w-fit py-10 px-10 lg:p-0 fixed lg:static top-0 right-[-240px] flex flex-col lg:flex-row gap-3 lg:gap-5 bg-white shadow-lg lg:shadow-none lg:justify-end lg:items-center">
            <div class="w-full flex lg:hidden justify-end">
                <label for="header-nav-toggler-button" aria-label="Toggle navigation">
                    <span class="fas fa-xmark text-2xl"></span>
                </label>
            </div>
            <ul class="w-full lg:w-fit lg:h-fit grid lg:grid-flow-col gap-y-5 auto-cols-max auto-rows-min
            lg:justify-end lg:items-center lg:gap-0 lg:gap-x-7">
                <li>
                    <a class="font-bold" href="/">Home</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('menu') ?>">Menu</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('offers') ?>">Offers</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('site.aboutus') ?>">About us</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('account.signup') ?>">Log in</a>
                </li>
                <li>
                    <a class="btn btn-primary font-bold" href="<?= $this->route('account.signup') ?>" role="button" title="Sign up">Sign up</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <div class="h-full w-60 lg:w-fit py-10 px-10 lg:p-0 absolute lg:static top-0 flex flex-col lg:flex-row gap-3 lg:gap-5 bg-white shadow-lg
    lg:shadow-none lg:justify-end lg:items-center" id="header-nav">
            <div class="w-full flex lg:hidden justify-end">
                <label for="header-nav-toggler-button" aria-label="Toggle navigation">
                    <span class="fas fa-xmark text-2xl"></span>
                </label>
            </div>
            <ul class="w-full lg:w-fit lg:h-fit grid lg:grid-flow-col gap-y-5 auto-cols-max auto-rows-min lg:justify-end lg:items-center lg:gap-0 lg:gap-x-7">
                <li>
                    <a class="font-bold" href="#">Home</a>
                </li>
                <li>
                    <a class="font-bold" href="#">Menu</a>
                </li>
                <li>
                    <a class="font-bold" href="#">Offers</a>
                </li>
                <li>
                    <a class="font-bold" href="#">About us</a>
                </li>
                <li>
                    <a class="font-bold" href="#">Log in</a>
                </li>
                <li class="">
                    <a class="btn btn-primary font-bold" href="#" role="button" title="Sign up">Sign up</a>
                </li>
            </ul>
    </div> -->
</header>
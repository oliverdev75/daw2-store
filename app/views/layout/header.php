<header class="w-full px-7 py-5 shadow-lg">
    <nav class="w-full grid grid-flow-col justify-between items-center overflow-hidden">
        <a class="w-fit flex gap-x-3 items-center" href="/">
            <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
            <span class="text-xl font-bold hidden md:inline">SymfonyRestaurant</span>
        </a>
        <label class="lg:hidden" for="header-nav-toggler-button" aria-label="Toggle navigation">
            <i class="bi bi-list text-3xl"></i>
        </label>
        <input id="header-nav-toggler-button" class="sidepanel-toggler-button hidden" type="checkbox">
        <div class="sidepanel h-full w-60 lg:w-fit py-10 px-10 lg:p-0 fixed lg:static top-0 right-[-240px] flex flex-col lg:flex-row gap-3 lg:gap-5 bg-white shadow-lg lg:shadow-none lg:justify-end lg:items-center">
            <div class="w-full flex lg:hidden justify-end">
                <label for="header-nav-toggler-button" aria-label="Toggle navigation">
                    <i class="bi bi-x-lg text-2xl"></i>
                </label>
            </div>
            <ul class="w-full lg:w-fit lg:h-fit grid lg:grid-flow-col gap-y-5 auto-cols-max auto-rows-min
            lg:justify-end lg:items-center lg:gap-0 lg:gap-x-7">
                <li>
                    <a class="font-bold" href="/">Home</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('product.index') ?>">Menu</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('offers') ?>">Offers</a>
                </li>
                <li>
                    <a class="font-bold" href="<?= $this->route('site.aboutus') ?>">About us</a>
                </li>
                <?php if (!is_null($user)): ?>
                    <li>
                        <a href="<?= $this->route('user.cart') ?>">
                            <i class="bi bi-cart2 text-2xl"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->route('user.logout') ?>">
                            LOG OUT
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="font-bold" href="<?= $this->route('user.login') ?>">Log in</a>
                    </li>
                    <li>
                        <a class="btn btn-primary font-bold" href="<?= $this->route('user.signup') ?>" role="button" title="Sign up">Sign up</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>
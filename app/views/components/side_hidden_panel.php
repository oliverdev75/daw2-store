<input id="header-nav-toggler-button" class="hidden" type="checkbox">
    <div id="header-nav" class="h-full w-60 lg:w-fit py-10 px-10 lg:p-0 fixed lg:static top-0 right-[-240px] flex flex-col lg:flex-row gap-3 lg:gap-5 bg-white shadow-lg lg:shadow-none lg:justify-end lg:items-center">
        <div class="w-full flex lg:hidden justify-end">
            <label for="header-nav-toggler-button" aria-label="Toggle navigation">
                <span class="fas fa-xmark text-2xl"></span>
            </label>
        </div>
    <ul class="w-full lg:w-fit lg:h-fit grid lg:grid-flow-col gap-y-5 auto-cols-max auto-rows-min lg:justify-end lg:items-center lg:gap-0 lg:gap-x-7">
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
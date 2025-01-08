<header class="h-full pe-5">
    <nav class="h-full flex flex-col justify-between">
        <div class="w-full grid auto-rows-max">
            <a class="justify-self-center block px-7 py-5 h-fit w-fit flex gap-x-3 items-center hover:bg-transparent" href="/">
                <img src="/assets/img/logo.svg" class="w-14 h-14" alt="SymfonyRestaurant logo">
                <span class="text-lg font-bold">SymfonyRestaurant</span>
            </a>
            <ul class="list-none">
                <li>
                    <a class="block pl-7 pr-40 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'users' ? 'active' : '' ?>" href="<?= $this->route('admin.users') ?>">
                        <i class="bi bi-people text-2xl"></i>
                        <span class="font-bold">Users</span>
                    </a>
                </li>
                <li>
                    <a class="block pl-7 pr-40 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'products' ? 'active' : '' ?>" href="<?= $this->route('admin.products') ?>">
                        <i class="bi bi-shop text-2xl"></i>
                        <span class="font-bold">Products</span>
                    </a>
                </li>
                <li>
                    <a class="block pl-7 pr-40 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'ingredients' ? 'active' : '' ?>" href="<?= $this->route('admin.ingredients') ?>">
                        <i class="bi bi-egg text-2xl"></i>
                        <span class="font-bold">Ingredients</span>
                    </a>
                </li>
                <li>
                    <a class="block pl-7 pr-40 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'orders' ? 'active' : '' ?>" href="<?= $this->route('admin.orders') ?>">
                        <i class="bi bi-receipt-cutoff text-2xl"></i>
                        <span class="font-bold">Orders</span>
                    </a>
                </li>
                <li>
                    <a class="block pl-7 pr-40 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'logs' ? 'active' : '' ?>" href="<?= $this->route('admin.logs') ?>">
                        <i class="bi bi-list-task text-2xl"></i>
                        <span class="font-bold">Logs</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="pl-10 py-9 flex items-center justify-between">
            <span class="text-xl font-bold"><?= $user->getCompleteName() ?></span>
            <a class="hover:bg-none" href="<?= $this->route('product.index') ?>">Go restaurant</a>
            <a class="hover:bg-none" href="<?= $this->route('user.logout') ?>">Log out</a>
        </div>
    </nav>
</header>
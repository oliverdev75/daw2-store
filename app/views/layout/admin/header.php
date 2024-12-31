<header class="h-full pe-3">
    <nav class="h-full flex flex-col justify-between">
        <div class="w-full grid auto-rows-max">
            <a class="justify-self-center block px-7 py-5 h-fit w-fit flex gap-x-3 items-center hover:bg-transparent" href="/">
                <img src="<?= $this->image('logo') ?>" class="w-14 h-14" alt="SymfonyRestaurant logo">
                <span class="text-lg font-bold text-white">SymfonyRestaurant</span>
            </a>
            <ul class="list-none">
                <li>
                    <a class="block px-7 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'users' ? 'active' : '' ?>" href="<?= $this->route('admin.users') ?>">
                        <i class="bi bi-people text-2xl text-white"></i>
                        <span class="text-white font-bold">Users</span>
                    </a>
                </li>
                <li>
                    <a class="block px-7 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'products' ? 'active' : '' ?>" href="<?= $this->route('admin.products') ?>">
                        <i class="bi bi-shop text-2xl text-white"></i>
                        <span class="text-white font-bold">Products</span>
                    </a>
                </li>
                <li>
                    <a class="block px-7 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'ingredients' ? 'active' : '' ?>" href="<?= $this->route('admin.ingredients') ?>">
                        <i class="bi bi-egg text-2xl text-white"></i>
                        <span class="text-white font-bold">Ingredients</span>
                    </a>
                </li>
                <li>
                    <a class="block px-7 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'orders' ? 'active' : '' ?>" href="<?= $this->route('admin.orders') ?>">
                        <i class="bi bi-receipt-cutoff text-2xl text-white"></i>
                        <span class="text-white font-bold">Orders</span>
                    </a>
                </li>
                <li>
                    <a class="block px-7 py-4 flex items-center gap-x-3 text-xl rounded-e-full <?= $active == 'config' ? 'active' : '' ?>" href="<?= $this->route('admin.config') ?>">
                        <i class="bi bi-gear text-2xl text-white"></i>
                        <span class="text-white font-bold">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
        <a class="block px-7 py-5 text-xl text-white font-bold  <?= $active == 'account' ? 'active' : '' ?>" href=""><?= $user->getCompleteName() ?></a>
    </nav>
</header>
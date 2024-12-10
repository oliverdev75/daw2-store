<div class="grow w-full min-h-[42rem] grid place-content-center">
    <div class="px-16 py-20 grid gap-y-10 border border-neutral-400 rounded-lg">
        <form class="grid gap-y-20" action="<?= $this->route('user.auth') ?>" method="post">
            <h1 class="text-4xl text-center heading-important">Welcome back!</h1>
            <div class="grid justify-items-center gap-y-5">
                <span class="text-sm text-center text-neutral-400 font-bold">Please remember us your data</span>
                <div class="flex flex-col gap-y-5">
                    <input class="input-text text-lg" type="email" name="username" placeholder="Username" required>
                    <input class="input-text text-lg" type="password" name="password" placeholder="Password" required>
                </div>
                <button class="btn btn-primary text-lg w-full" type="submit">Log in</button>
            </div>
        </form>
        <span class="text-sm text-center text-neutral-500 font-bold">
            Don't have an account?
            <a class="font-semibold" href="<?= $this->route('user.signup') ?>">
                Create account
            </a>
        </span>
    </div>
</div>
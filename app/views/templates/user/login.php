<div class="grow w-full min-h-[42rem] grid place-content-center">
    <div class="min-w-[25rem] px-8 py-12 grid gap-y-10 border border-neutral-400 rounded-lg">
        <form class="grid gap-y-12" action="<?= $this->route('user.auth') ?>" method="post">
            <h1 class="text-4xl text-center heading-important">Welcome back!</h1>
            <div class="grid justify-items-center gap-y-5">
                <?php if (isset($message)): ?>
                    <div class="message message-danger"><?= $message ?></div>
                <?php endif ?>
                <span class="text-sm text-center text-neutral-400 font-bold">Please remember us your data</span>
                <div class="w-full flex flex-col gap-y-5">
                    <input type="hidden" name="src" value="<?= $src ?? '' ?>">
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
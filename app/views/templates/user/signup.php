<div class="grow w-full min-h-[60rem] grid place-content-center">
    <div class="max-w-[50rem] px-14 py-16 grid gap-y-10 border border-neutral-400 rounded-lg">
        <form class="grid gap-y-20" action="<?= $this->route('user.store') ?>" method="post">
            <h1 class="text-4xl text-center heading-important">Welcome to our restaurant!</h1>
            <div class="grid justify-items-center gap-y-4">
                <?php if (isset($message)): ?>
                    <div class="message message-danger"><?= $message ?></div>
                <?php endif ?>
                <span class="text-center text-neutral-400 font-bold">Please introduce your data</span>
                <div class="w-full flex flex-col gap-y-5">
                    <input class="input-text text-md" type="text" name="name" placeholder="Name" required>
                    <input class="input-text text-md" type="text" name="surnames" placeholder="Surnames">
                    <input class="input-text text-md" type="email" name="email" placeholder="Email" required>
                    <div class="outline-8 mt-5 px-5 py-5 grid gap-y-2 border-t border-neutral-300">
                        <input class="input-text text-md" type="password" name="password" placeholder="Password" pattern="[A-Za-z0-9\W]{8,}" required>
                        <input class="input-text text-md" type="password" name="password_confirm" placeholder="Confirm password" required>
                        <ul class="ms-7 list-disc">
                            <li class="font-semibold">1 lowercase letter</li>
                            <li class="font-semibold">1 uppercase letter</li>
                            <li class="font-semibold">1 number</li>
                            <li class="font-semibold">1 special character</li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-primary text-md w-full" type="submit">Sign up</button>
            </div>
        </form>
        <span class="text-sm text-center text-neutral-500 font-bold">
            Already have an account?
            <a class="font-semibold" href="<?= $this->route('user.login') ?>">
                Log in
            </a>
        </span>
    </div>
</div>
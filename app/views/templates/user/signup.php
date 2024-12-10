<div class="grow w-full min-h-[50rem] grid place-content-center">
    <div class="max-w-[50rem] px-14 py-16 grid gap-y-10 border border-neutral-400 rounded-lg">
        <form class="grid gap-y-20" action="<?= $this->route('user.store') ?>" method="post">
            <h1 class="text-4xl text-center heading-important">Welcome to our restaurant!</h1>
            <div class="grid justify-items-center gap-y-9">
                <span class="text-center text-neutral-400 font-bold">Please introduce your data</span>
                <div class="w-full flex flex-col gap-y-5">
                    <input class="input-text text-md" type="text" name="name" placeholder="Name" required>
                    <input class="input-text text-md" type="text" name="surnames" placeholder="Surnames">
                    <input class="input-text text-md" type="email" name="username" placeholder="Email" required>
                    <input class="input-text text-md" type="password" name="password" placeholder="Password" required>
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
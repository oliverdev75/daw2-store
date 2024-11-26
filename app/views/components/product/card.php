<article class="p-5 grid gap-y-4 rounded-lg container-shadow">
    <div class="flex justify-center items-center">
        <img class="w-50" src="<?= $this->image('home.ceviche') ?>" alt="Ceviche">
    </div>
    <div class="grid gap-y-6">
        <div class="flex flex-col gap-y-2">
            <span>Principals</span>
            <span class="text-2xl font-bold">Ceviche</span>
        </div>
        <div class="justify-self-end w-full grid gap-y-2">
            <a class="btn btn-tertiary btn-full" role="button" href="">Details</a>
            <form action="" method="post">
                <input type="hidden" name="id" value="">
                <button class="btn btn-secondary btn-full" type="submit">Add to cart</button>
            </form>
        </div>
    </div>
</article>
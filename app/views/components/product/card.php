<article class="p-5 grid md:grid-cols-4 md:grid-flow-col md:gap-x-4 container-shadow">
    <div class="flex justify-center items-center">
        <img class="w-50" src="<?= $this->image('home.ceviche') ?>" alt="Ceviche">
    </div>
    <div class="col-span-3 w-full grid gap-y-5">
        <div class="grid md:grid-rows-2 md:grid-cols-2 md:gap-y-5">
            <div class="flex flex-col gap-y-2">
                <span>Principals</span>
                <span class="text-3xl font-bold">Ceviche</span>
            </div>
            <div class="justify-self-end w-fit h-fit grid grid-flow-col md:gap-x-5">
                <a class="btn btn-tertiary" role="button" href="">Details</a>
                <form action="" method="post">
                    <input type="hidden" name="id" value="">
                    <button class="btn btn-secondary" type="submit">Add to cart</button>
                </form>
            </div>
            <p class="col-span-2 h-full product-card-desc-shadow">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Aenean dapibus, massa et cursus viverra, libero lacus sodales sem, 
                a ullamcorper ligula purus sed risus. Aenean vel purus consequat, 
                laoreet libero nec, porta ligula. Nunc et purus tortor. 
                Vestibulum eu pellentesque eros, sit amet varius orci.
            </p>
        </div>
    </div>
</article>
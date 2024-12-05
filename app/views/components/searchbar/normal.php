<form action="<?= $formEndpoint ?>" method="get">
    <div class="grid grid-rows-2 grid-cols-1 min-[1120px]:grid-cols-2 justify-items-center md:justify-items-start gap-y-3">
        <div class="col-span-2 flex gap-2 md:gap-0 h-fit px-5 md:px-3 py-[6px] justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
            <input class="w-full focus:outline-none" type="text" name="<?= $name ?>" placeholder="Search by product name..." value="<?= $defaultValue ?>">
            <button class="md:px-3" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>
</form>
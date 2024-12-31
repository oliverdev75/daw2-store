<form action="<?= $formEndpoint ?>" method="get">
    <div class="flex gap-2 md:gap-0 h-fit px-5 md:px-3 py-[6px] justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
        <input class="w-full focus:outline-none" type="text" name="<?= $name ?>" placeholder="<?= $placeholder ?>" value="<?= $defaultValue ?>">
        <button type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
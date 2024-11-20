<form action="<?= $formEndpoint ?>" method="get">
    <div class="w-full h-fit px-3 py-[6px] flex justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
        <input class="w-full focus:outline-none" type="text" name="<?= $name ?>" placeholder="Search by product name..." value="<?= $defaultValue ?>">
        <button type="submit">
            <i class="icon-size fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</form>
<div class="menu-filter hidden min-[1120px]:block h-fit">
    <form class="grid gap-y-5" method="get">
        <h2 class="text-2xl">Filter</h2>
        <div class="flex flex-col gap-y-3">
            <h3>Categories</h3>
            <div class="ms-2 flex flex-col gap-y-3">
                <?php
                    $this->component('form.checkbox', [
                        'label' => 'Snacks',
                        'name' => 'snacks',
                        'id' => 'snacks'
                    ])
                ?>
                <?php
                    $this->component('form.checkbox', [
                        'label' => 'Principals',
                        'name' => 'principals',
                        'id' => 'principals'
                    ])
                ?>
                <?php
                    $this->component('form.checkbox', [
                        'label' => 'Desserts',
                        'name' => 'desserts',
                        'id' => 'desserts'
                    ])
                ?>
            </div>
        </div>
        <button id="filter-apply-btn" class="hidden justify-self-center btn btn-secondary" type="submit">Apply</button>
    </form>
</div>
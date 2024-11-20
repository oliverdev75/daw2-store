<div class="flex flex-col gap-y-3 border-e border-solid menu-filter-border-color">
    <h2 class="text-2xl">Filter</h2>
    <form method="get">
        <div class="flex flex-col gap-y-3">
            <h3>Categories</h3>
            <div class="ms-2 flex flex-col gap-y-2">
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
        <button id="filter-apply-btn" class="btn btn-secondary" type="submit">Apply</button>
    </form>
</div>
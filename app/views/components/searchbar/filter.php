<?php $this->component('searchbar.open', compact('formEndpoint')) ?>
    <label class="w-full md:w-fit row-start-3 sm:row-start-2 justify-self-center" for="">
        <button class="btn btn-secondary w-full md:w-fit">
            <span class="text-white">Filter</span>
            <i class="fa-solid fa-sliders fa-lg text-white"></i>
        </button>
    </label>
    <?php $this->component('side_hidden_panel.open') ?>
        <div class="menu-filter hidden min-[1120px]:block h-fit border-e border-solid menu-filter-border-color">
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
    <?php $this->component('side_hidden_panel.close') ?>
    <div class="row-start-2 flex items-center gap-3">
        <label for="results-order">Order by</label>
        <select class="px-5 py-3 md:px-3 md:py-2 rounded" name="order" id="results-order">
            <option value="none" selected>All</option>
            <?php foreach($options as $option => $optionValue): ?>
                <option class="bg-white hover:active:bg-sea-blue hover:cursor-pointer" value="<?= $optionValue ?>"><?= $option ?></option>
            <?php endforeach ?>
        </select>
    </div>
<?php $this->component('searchbar.close') ?>

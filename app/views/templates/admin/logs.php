<h1 class="text-4xl font-light">Logs</h1>
<div class="mt-10 grid auto-rows-max gap-y-5">
    <div id="message-placeholder" class="message" style="display: none"></div>
    <div class="flex gap-2 md:gap-0 h-fit px-5 md:px-3 py-[6px] justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
        <input class="w-full focus:outline-none" type="text" placeholder="Search log by name...">
    </div>
    <div class="h-fit border border-solid border-neutral-200 rounded-md">
        <table id="data-table" class="w-full">
            <thead class="border-b border-solid border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-start">User</th>
                    <th class="px-4 py-3 text-start">Action</th>
                    <th class="px-4 py-3 text-start">Order id</th>
                    <th class="px-4 py-3 text-start">Product id</th>
                    <th class="px-4 py-3 text-start">Ingedient id</th>
                    <th class="px-4 py-3 text-start">Creation time</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script type="module" src="<?= $this->js('admin.datatables.logs') ?>"></script>
</div>
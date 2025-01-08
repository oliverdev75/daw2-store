<h1 class="text-4xl font-light">Users</h1>
<div class="mt-10 grid auto-rows-max gap-y-5">
    <div id="message-placeholder" class="message" style="display: none"></div>
    <button class="btn btn-primary justify-self-end flex items-center gap-x-2 text-lg">
        <span class="text-white">Create</span>    
        <i class="bi bi-person text-white text-2xl"></i>
    </button>
    <div class="flex gap-2 md:gap-0 h-fit px-5 md:px-3 py-[6px] justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
        <input class="w-full focus:outline-none" type="text" placeholder="Search users by name...">
    </div>
    <div class="h-fit border border-solid border-neutral-200 rounded-md">
        <table id="data-table" class="w-full">
            <thead class="border-b border-solid border-neutral-200">
                <tr>
                    <th class="px-4 py-3 text-start">Name</th>
                    <th class="px-4 py-3 text-start">Surnames</th>
                    <th class="px-4 py-3 text-start">Email</th>
                    <th class="px-4 py-3 text-start">Role</th>
                    <th class="px-4 py-3 text-start">Creation time</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script type="module" src="<?= $this->js('admin.datatables.users') ?>"></script>
</div>
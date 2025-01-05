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
        </table>
    </div>
    <!-- <button class="btn btn-secondary modal-open-btn" data-modal="modal-del">Open</button>
    <div id="modal-del" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-body">
                <p class="font-semibold text-lg">Sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-tertiary modal-close-btn">Cancel</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>

    <button class="btn btn-secondary modal-open-btn" data-modal="modal-edit">Open</button>
    <div id="modal-edit" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header flex justify-between items-center">
                <h2 class="text-3xl">Edit user</h2>
                <button class="btn text-neutral-500 modal-close-btn">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body flex flex-col gap-y-5">
                <div class="flex gap-x-5">
                    <div class="flex flex-col">
                        <label class="mb-px font-semibold text-sm text-neutral-500" for="name">Name:</label>
                        <input id="name" class="input-text" type="text" value="John">
                    </div>
                    <div class="flex flex-col">
                        <label class="mb-px font-semibold text-sm text-neutral-500" for="surnames">Surnames:</label>
                        <input class="input-text" type="text" value="Doe">
                    </div>
                </div>
                <div class="flex gap-x-5">
                    <input class="input-text" type="password" name="" id="" value="xxxxxxx">
                    <input class="input-text" type="password" name="" id="" value="xxxxxxx">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-tertiary modal-close-btn">Cancel</button>
                <button class="btn btn-secondary">Edit</button>
            </div>
        </div>
    </div> -->
    <script type="module" src="<?= $this->js('admin.datatables.users') ?>"></script>
</div>
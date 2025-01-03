<h1 class="text-4xl font-light">Users</h1>
<div class="mt-10 grid auto-rows-max gap-y-5">
    <button class="btn btn-primary justify-self-end flex items-center gap-x-2 text-lg">
        <span class="text-white">Create</span>    
        <i class="bi bi-person text-white text-2xl"></i>
    </button>
    <div class="flex gap-2 md:gap-0 h-fit px-5 md:px-3 py-[6px] justify-between rounded-[0.1rem] border border-solid border-neutral-500 text-neutral-500">
        <input class="w-full focus:outline-none" type="text" placeholder="Search users by name...">
    </div>
    <div class="h-fit border border-solid border-neutral-200 rounded-md">
        <table class="w-full">
            <thead class="border-b border-solid border-neutral-200">
                    <th class="px-4 py-3 text-start">Name</th>
                    <th class="px-4 py-3 text-start">Surnames</th>
                    <th class="px-4 py-3 text-start">Email</th>
                    <th class="px-4 py-3 text-start">Role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-3">John</td>
                    <td class="px-4 py-3">Doe</td>
                    <td class="px-4 py-3">john.doe@email.com</td>
                    <td class="px-4 py-3">Manager</td>
                    <td>
                        <button class="px-2 py-1 bg-blue-500 hover:bg-blue-600 rounded">
                            <i class="bi bi-pencil-square text-white"></i>
                        </button>
                        <button class="px-2 py-1 bg-red-500 hover:bg-red-600 rounded">
                            <i class="bi bi-trash text-white"></i>
                        </button>
                    </td>
                </tr>
          </tbody>
        </table>
    </div>
    <button class="btn btn-secondary modal-open-btn" data-modal="modal-del">Open</button>
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
                    <input class="input-text" type="text" value="John">
                    <input class="input-text" type="text" value="Doe">
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
    </div>
</div>
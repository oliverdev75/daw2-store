<div class="input checkbox flex items-center gap-x-2">
    <div class="grid place-content-center checkbox-box size-px p-2.5 rounded-md checkbox-box-color">
        <div class="checkbox-box size-[0.9rem] rounded"></div>
    </div>
    <input id="<?= $id ?>" class="hidden" type="radio" name="<?= $name ?>" value="<?= $value ?>">
    <label class="text-sm" for="<?= $id ?>"><?= $label ?></label>
</div>
<div class="grid gap-y-5">
    <?php $this->component('dish.comment', ['text' => $commentText]) ?>
    <?php
        $this->component('user.profile.image_with_name', [
            'image' => $userImage,
            'imageAlt' => $userImageAlt,
            'userName' => $userName
        ])
    ?>
</div>

<div class="lg:mx-40">
    <section class="py-20 lg:p-0 grid lg:grid-rows-1 lg:grid-cols-2 lg:gap-5 items-start">
        <div class="w-full lg:w-fit h-full grid lg:grid-cols-1 justify-center lg:justify-start
        content-center auto-rows-min gap-y-5 text-center md:text-left">
            <h1 class="text-[2rem]/[40px] min-[1121px]:text-4xl min-[1374px]:text-6xl text-white
            text-[#303952]">Reach the infinite with our dishes variety</h1>
            <div class="w-full lg:w-fit px-3 lg:p-0 grid lg:grid-rows-2 auto-rows-max gap-y-3 lg:gap-y-2 text-center lg:text-start">
                <p class="text-lg lg:text-2xl">We have a lot of dishes, from principals to desserts</p>
                <div class="w-full lg:w-fit grid grid-flow-col auto-rows-max auto-cols-max justify-center lg:justify-start gap-x-5">
                    <a class="btn btn-secondary" title="Sign up" href="">Sign up</a>
                    <a class="btn btn-tertiary" title="Menu" href="">Menu</a>
                </div>
            </div>
        </div>
        <div class="hidden lg:flex justify-end">
            <img class="object-contain" src="<?= $this->image('home.cat_space') ?>" alt="Astronaut cat in space">
        </div>
    </section>
    <section class="px-10 py-12 md:p-0 md:py-28 grid lg:grid-rows-4 auto-rows-max justify-center gap-y-12 md:gap-y-10 lg:gap-0">
        <h3 class="text-2xl md:text-3xl min-[1121px]:text-2xl min-[1374px]:text-4xl text-center text-[#303952]">Enjoy the best sea flavors!</h3>
        <div class="md:row-span-3 grid grid-rows-3 md:grid-rows-2 md:grid-cols-2 justify-items-center
        md:justify-items-start gap-y-5 md:gap-x-10 md:gap-y-5">
            <img class="w-44 md:w-64 lg:w-80 md:col-span-2 justify-self-center" src="<?= $this->image('home.ceviche') ?>" alt="Ceviche">
            <img class="w-44 md:w-64 lg:w-80 md:row-start-2 md:col-start-1 object-cover" src="<?= $this->image('home.salmon') ?>" alt="Salmon">
            <img class="w-44 md:w-64 lg:w-80 md:row-start-2 md:col-start-2 object-cover" src="<?= $this->image('home.prawns') ?>" alt="Lemmon prawns">
        </div>
    </section>
    <section class="py-12 md:py-20 grid gap-y-12 lg:gap-y-16">
        <h3 class="text-2xl md:text-3xl min-[1121px]:text-2xl min-[1374px]:text-4xl text-center text-[#303952]">Our clients say</h3>
        <div class="grid lg:grid-cols-3 justify-center justify-items-center gap-y-10 lg:gap-x-10">

            <?php
                $this->component('dish.user_comment', [
                    'commentText' => 'Maecenas erat velit, pulvinar ut sagittis a,
                    molestie at risus. Vivamus vel lorem aliquet ante cursus 
                    semper nec a libero. Curabitur interdum ipsum sed augue 
                    maximus varius.',
                    'userImage' => $this->image('home.profileImage1'),
                    'userImageAlt' => 'John Doe',
                    'userName' => 'John Doe'
                ])
            ?>
            <?php
                $this->component('dish.user_comment', [
                    'commentText' => 'Maecenas erat velit, pulvinar ut sagittis a,
                    molestie at risus. Vivamus vel lorem aliquet ante cursus 
                    semper nec a libero. Curabitur interdum ipsum sed augue 
                    maximus varius.',
                    'userImage' => $this->image('home.profileImage2'),
                    'userImageAlt' => 'John Doe',
                    'userName' => 'John Doe',
                ])
            ?>
            <?php
                $this->component('dish.user_comment', [
                    'commentText' => 'Maecenas erat velit, pulvinar ut sagittis a,
                    molestie at risus. Vivamus vel lorem aliquet ante cursus 
                    semper nec a libero. Curabitur interdum ipsum sed augue 
                    maximus varius.',
                    'userImage' => $this->image('home.profileImage3'),
                    'userImageAlt' => 'John Doe',
                    'userName' => 'John Doe',
                ])
            ?>
        </div>
    </section>
</div>
<section class="px-7 lg:px-0 py-20 md:py-36 bg-[url(<?= $this->image('home.space') ?>)] bg-center bg-no-repeat bg-cover">
    <div class="grid justify-center justify-items-center text-center gap-y-7">
        <h3 class="text-2xl md:text-3xl min-[1121px]:text-2xl min-[1374px]:text-4xl text-white">Join us and enjoy right now of all of our delicious eats!</h3>
        <a class="btn btn-secondary" role="button" href="">Sign up</a>
    </div>
</section>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="/assets/img/logo.svg" type="image/x-icon">
        <link rel="stylesheet" href="<?= $this->css('root') ?>">
        <link rel="stylesheet" href="<?= $this->css('site') ?>">
        <link rel="stylesheet" href="<?= $this->css('product') ?>">
        <link rel="stylesheet" href="<?= $this->css('admin.header') ?>">
        <link rel="stylesheet" href="<?= $this->css('admin.main') ?>">
        <title><?= $title ?></title>
    </head>
    <body>
        <div class="h-[100vh] w-full grid grid-cols-[1fr_4fr]">
            <?php $this->component('admin.header', ['user' => $data['user'], 'active' => $data['active']], 'layout') ?>
            <div>
                <main class="mt-20 mx-20">
                    <?php $this->component($templateParsedName, $data, 'body') ?>
                </main>
        
                <?php $this->component('admin.footer', [], 'layout') ?>
            </div>
        </div>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="<?= $this->js('form.checkbox') ?>"></script>
    </body>
</html>
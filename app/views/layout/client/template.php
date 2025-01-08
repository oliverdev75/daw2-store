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
    <link rel="stylesheet" href="<?= $this->css('client.header') ?>">
    <link rel="stylesheet" href="<?= $this->css('client.footer') ?>">
    <link rel="stylesheet" href="<?= $this->css('client.menu') ?>">
    <link rel="stylesheet" href="<?= $this->css('client.cart') ?>">
    <link rel="stylesheet" href="<?= $this->css('client.product.card') ?>">
    <title><?= $title ?></title>
</head>

<body>
    <?php $this->component('client.header', ['user' => $data['user']], 'layout') ?>

    <?php if ($templateParsedName != '.templates.site.index'): ?>
        <main class="min-h-full mx-5 sm:mx-10 md:mx-20 min-[1500px]:mx-48 min-[1900px]:mx-80 grow flex flex-col">
            <?php $this->component($templateParsedName, $data, 'body') ?>
        </main>
    <?php else: ?>
        <main>
            <?php $this->component($templateParsedName, $data, 'body') ?>
        </main>
    <?php endif; ?>

    <?php $this->component('client.footer', [], 'layout') ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?= $this->js('form.checkbox') ?>"></script>
    <script src="<?= $this->js('menu.filter') ?>"></script>
</body>

</html>
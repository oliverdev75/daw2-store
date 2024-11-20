<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= $this->css('root') ?>">
        <link rel="stylesheet" href="<?= $this->css('site') ?>">
        <link rel="stylesheet" href="<?= $this->css('header') ?>">
        <link rel="stylesheet" href="<?= $this->css('header') ?>">
        <title><?= $title ?></title>
    </head>
    <body>
        
        <?php $this->header(compact('user')) ?>

        <?php if($templateParsedName != '.templates.site.index'): ?>
            <main class="lg:mx-56">
                <?php $this->component($templateParsedName, $bodyData, 'body') ?>
            </main>
        <?php else: ?>
            <main>
                <?php $this->component($templateParsedName, $bodyData, 'body') ?>
            </main>
        <?php endif; ?>

        <?php $this->footer() ?>
        
        <script src="https://cdn.tailwindcss.com"></script>

        <script src="https://cdn.tailwindcss.com"></script>
        <script
            src="https://kit.fontawesome.com/fa5d3f8bd9.js"
            crossorigin="anonymous"
        ></script>

    </body>
</html>
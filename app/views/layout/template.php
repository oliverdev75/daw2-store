<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?= $this->css('root') ?>">
        <link rel="stylesheet" href="<?= $this->css('site') ?>">
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <?php $this->header(compact('user')) ?>
        </header>

        <main>
            <?php $this->component($bodyContent, $bodyData, 'body') ?>
        </main>

        <footer>
            <?php $this->footer() ?>
        </footer>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        >
        </script>
        <script
            src="https://kit.fontawesome.com/fa5d3f8bd9.js"
            crossorigin="anonymous"
        >
        </script>

    </body>
</html>
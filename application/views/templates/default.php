<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo $title; ?></title>
    <?php echo @$_head; ?>
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
</head>

<body>
    <div class="container-xxl">
        <div class="row">
            <div class="col">
                <h1>Default template</h1>
                <div class="wrapper">
                    <?php echo $body; ?>
                </div>`
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <?php echo @$_footer; ?>
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/header.css">    

    <title><?= $this->e($title) ?></title>
</head>

<body>
    <header class='header' data-animate-header-container>

        <!-- [data-animate-header] - this is the actual element that will be fixed/animated -->
        <menu class='header-bar' data-animate-header>
            <a href='/' class='btn-menu' data-toggle-class='menu-active'>Home</a>
            <a href='/login' class='btn-search' data-toggle-class='search-active'>Area riservata</a>
        </menu>
    </header>

    <article class='article'>
        <header class='article-header'>
            <?= $this->section('content') ?>
        </header>
    </article>
</body>
</html>
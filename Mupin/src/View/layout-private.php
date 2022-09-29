<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/header.css">

    <title><?= $this->e($title) ?></title>
</head>

<body>
    <header class='header'>
        
        <menu class='header-bar' data-animate-header>
            <a class='btn-menu' id='logout-btn' onclick='logout()'>Logout</a>            
            <a href='../../' class='btn-search' data-toggle-class='search-active'>Operazioni</a>
        </menu>
    </header>

    <article class='article'>
        <header class='article-header'>
            <?= $this->section('content') ?>
        </header>
    </article>
</body>
<script>
    function logout(){
        document.location = '../../logout';
    }
</script>
</html>
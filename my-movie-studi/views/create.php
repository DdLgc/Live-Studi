<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/main.css">
    <title>My Movies - Publier un film</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-film"></i>My Movies</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Publier un film</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php
    function loadClass(string $class)
    {
        if ($class === "DotEnv") {
            require_once "../config/$class.php";
        } else if (str_contains($class, "Controller")) {
            require_once "../Controller/$class.php";
        } else {
            require_once "../Entity/$class.php";
        }
    }
    spl_autoload_register("loadClass");
    $categoryController = new CategoryController();
    $categories = $categoryController->getAll();

    if ($_POST) {
        $movieController = new MovieController();
        $newMovie = new Movie($_POST);
        $movieController->create($newMovie);
    } ?>
    <main>
        <h3>Publier un nouveau film</h3>
        <form class="container-fluid w-50" method="POST">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" placeholder="Le titre du film" class="form-control">
            <label for="description">Synopsis</label>
            <textarea name="description" id="description" rows="10" placeholder="Le r??sum?? du film" class="form-control"></textarea>
            <label for="image_url">Image</label>
            <input type="url" name="image_url" id="image_url" placeholder="L'URL de l'image du film" class="form-control">
            <label for="release_date">Date de sortie</label>
            <input type="date" name="release_date" id="release_date" class="form-control">
            <label for="director">R??alisateur</label>
            <input type="text" name="director" id="director" placeholder="Le r??alisateur du film" class="form-control">
            <label for="category_id">Cat??gorie</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="" selected>-- S??lectionnez une cat??gorie --</option>
                <?php
                foreach ($categories as $category) : ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="Publier" class="btn btn-primary mt-3">
        </form>
    </main>
</body>

</html>
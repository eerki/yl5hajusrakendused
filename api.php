<?php

$t = filter_input(INPUT_GET, 't', FILTER_SANITIZE_STRING);
    
    switch ($t) {
        case 'topic1':
            $url = 'https://tak17.janek.itmajakas.ee/code/hajusrakendused/ylesanne5?k=2';
            $cacheFile = './cache/topic1.json';
            $cacheTime= 300;
        break;
    
        case 'topic2':
            $url = ' https://favorite-subject.tak17koost.itmajakas.ee';
            $cacheFile = './cache/topic2.json';
            $cacheTime= 600;
        break;

        default:
            $url = 'http://yl5hajusrakendused.tak17pold.itmajakas.ee?k=1';
            $cacheFile = './cache/default.json';
            $cacheTime= 200;
        }

    if ( file_exists($cacheFile) && (time() - filemtime($cacheFile)) <$cacheTime ) {
        $data = json_decode(file_get_contents($cacheFile));

    } else {
        $data = json_decode(file_get_contents($url));

        $file = fopen($cacheFile, 'w');
        
        fwrite($file, json_encode($data));
        fclose($file);
    }

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="col-4">
        <ul>
            <li><a href="?t=topic1">Topic 1</a></li>
            <li><a href="?t=topic2">Topic 2</a></li>
        </ul>
    </div>
    <div class="col-8">
        <?php if (empty($data)) : ?>
            <div class="alert alert-danger">Data missing!</div>
        <?php else: ?>
            <?php

                echo $data->info->name . " - " . $data->info->description . '<br>';

                //var_dump($data);

                foreach ($data->data as $row) { ?>

                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $row->image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row->title; ?></h5>
                            <p class="card-text"><?php echo $row->description; ?></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                <?php }
            ?>
        <?php endif; ?>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
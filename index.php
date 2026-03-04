    <?php
  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  $pageSize = 52;
  $pesquisa = $_GET['search'] ?? '';

  $url = "https://api.disneyapi.dev/character?page={$page}&pageSize={$pageSize}";
  if(!empty($pesquisa)) { $url .= "&name=" . urlencode($pesquisa); }

  $response = @file_get_contents($url);
  $data = $response ? json_decode($response, true) : null;

  $personagens = $data['data'] ?? [];
  
  if (isset($personagens['_id'])) { $personagens = [$personagens]; }

  $totalPages = $data['info']['totalPages'] ?? 1;
?>

  <!DOCTYPE html>
  <html lang="en">
        <head>
          <meta charset="UTF-8">
          <link rel="stylesheet" href="style.css"/>
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://db.onlinewebfonts.com/c/130a63bec7d0efc605bbe6253a27de98?family=InspireTWDC" rel="stylesheet">
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
          <title>Disney</title>
          <link href="css/style.css?v=<?php echo rand();?>" type="text/css" rel="stylesheet">
        </head>
    <body>
        <div class = "header">
            <img src ='Imagens/walt_disney_PNG38.png'>
            <h1>A magia vive em cada personagem</h1>
          <div class = "pesquisa">
            <form method="GET">
              <input type="text" name="search" placeholder="Pesquisar" value="<?php echo $pesquisa ?? ''; ?>">
            </form>
          </div>  
        </div>

      <div class = "container">
        
          <?php foreach ($personagens as $personagem) { ?>
          <div class = "container-single" >
            <?php if( !empty($personagem['imageUrl'])) { ?>
            <img src="<?=$personagem['imageUrl'] ?>" alt ="";"><br><br>
            <?php } else { ?>
            <img src="https://static.wikia.nocookie.net/disney/images/0/0e/Old-yeller-2-movie-collection-20060206040952451-000.jpg" alt ="";"><br><br>
            <?php } ?>
              <h2><?php echo $personagem['name'] . "<br>";?></h2>
              <?php if( !empty($personagem['films'])) { ?>
              <h3><?php echo "<br> Filmes: " . implode(", ", $personagem['films']) . "<br>";?></h3>
              <?php }?>
              <?php if( !empty($personagem['tvShows'])) { ?>
              <h3><?php echo "Séries: " . implode(", ", $personagem['tvShows']) . "<br>";?></h3>
              <?php } ?>
              <?php if( !empty($personagem['shortFilms'])) { ?>
              <h3><?php echo "Curtas: " . implode(", ", $personagem['shortFilms']) . "<br>";?></h3>
              <?php }?>
              <?php if( !empty($personagem['videoGames'])) { ?>
              <h3><?php echo "Video Games: " . implode(", ", $personagem['videoGames']) . "<br><br><br>";?></h3>
              <?php }?>
              <h3><?php echo "<br><br><br>"?></h3>
          </div> <?php } ?>
          </div>

        
      </div>

          <?php
          $inicio = max(1,$page -1);
          $final = min($totalPages, $page +1);
          ?>
          <ul class="pagination">
              <?php if($page > 1) : ?>
                  <li><a href="?page=<?=$page - 1?>&search=<?=urlencode($pesquisa)?>"><</a></li>
              <?php endif;?>

              <?php for($i=$inicio;$i<=$final;$i++): ?>
                  <li><a href="?page=<?=$i?>&search=<?=urlencode($pesquisa)?>" class="<?=($i==$page) ? 'active' : ''?>"><?=$i?></a></li>
              <?php endfor; ?>

              <?php if($page < $totalPages): ?>
                  <li><a href="?page=<?=$page + 1?>&search=<?=urlencode($pesquisa)?>">></a></li>
              <?php endif; ?>
          </ul>

    </body>
      <footer class = footer>
          <p>© 2026 Disney e suas empresas afiliadas. Todos os direitos reservados.
          Para usar o Disney+, é necessário ser assinante e ter mais de 18 anos de idade. Conteúdo sujeito a disponibilidade.</p>
      </footer>
  </html>

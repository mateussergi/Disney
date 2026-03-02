    <?php

      $url = "https://api.disneyapi.dev/character?pageSize=197";


      $context = stream_context_create(['http' => ['timeout' => 10]]);
      $response = @file_get_contents($url, false, $context);

      $data = $response ? json_decode($response, true) : null;

      $personagens = $data['data'] ?? [];
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
        </head>
  <body>
      <div class = "header">
        <img src ='Imagens/walt_disney_PNG38.png'>
        <h1>A magia vive em cada personagem</h1>
      </div>

      <div class = "container">
        
          <?php foreach ($personagens as $personagem) { ?>
          <div class = "container-single" >
            <img src="<?=$personagem['imageUrl'] ?>" alt ="";"><br><br>
              <h2><?php echo $personagem['name'] . "<br>";?></h2>
              <h3><?php echo implode(", ", $personagem['films']) . "<br><br>";?></h2>
          </div> <?php } ?>
          </div>
          ?>
        
      </div>
  </body>
  <footer class = footer>
      <p>© 2026 Disney e suas empresas afiliadas. Todos os direitos reservados.
Para usar o Disney+, é necessário ser assinante e ter mais de 18 anos de idade. Conteúdo sujeito a disponibilidade.</p>
  </footer>
      </html>

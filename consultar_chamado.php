<?php 
  require_once "validador_acesso.php"
?>

<?php 

  $chamados = array();

  // ABRIR o arquivo e o 'r' é p LER o arquivo
  $arquivo = fopen('arquivo.hd', 'r');


  // enquanto houver registros (linhas) a serem recuperados (lidos)
  // FEOF => testa pelo fim do arquivo - End Of File
  // inverte '!' para n retornar 'false' cada vez q o 'feof' termina de ler uma linha, já que utilizei o 'PHP_EOL' p quebrar uma linha após cada cadastro de chamado
  while(!feof($arquivo)) { 

    $registro = fgets($arquivo); // 'fgets pega os registros do arquivo
    $chamados[] = $registro;
  }

  // FECHAR o arquivo
  fclose($arquivo);


?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">

            <?php foreach($chamados as $chamado) { ?>

                <?php 
                  // explode() divide uma string em um array de substrings com base em um delimitador, nesse caso é '#'
                  // para que cada 'atributo' do $chamado tenha uma posição no array e assim eu consiga colocar, por ex
                  // o atributo 'titulo' no card 'titulo do chamado', a categoria em 'categoria' e a descricao em 'descricao'
                  $chamado_dados = explode('#', $chamado);

                  // 'igual a 2' pq o perfil_id 2 é de usuario, perfil_id 1 é de adm
                  if($_SESSION['perfil_id'] == 2) {
                    // só vai exibir o chamado se ele foi criado pelo usuário atual
                    if($_SESSION['id'] != $chamado_dados[0]){
                      continue; // 'continue' pula uma iteração e desconsidera o resto do código,
                      // nesse caso, ele pula o chamado cadastrado q n pertence ao usuário atual
                    }

                  }

                  // expressão 'continue' para pular um iteração de um looping, nesse caso p pular a iteracao da linha vazia que se cria pelo comando 'PHP_EOL' (quebra a linha a cada cadastro)
                  // mas pode pula a iteração do looping caso ex. a 'descricao' esteja vazia, dai não mostra na tela o card do chamado
                  // inferior a 3 pq são 3 'atributos' a serem cadastrados a cada chamado
                  if(count($chamado_dados) < 3) {
                    continue;
                  }
                ?>

                  <div class="card mb-3 bg-light">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo "$chamado_dados[1]"?></h5>
                      <h6 class="card-subtitle mb-2 text-muted"><?php echo "$chamado_dados[2]"?></h6>
                      <p class="card-text"><?php echo "$chamado_dados[3]"?></p>

                    </div>
                  </div>

              <?php } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
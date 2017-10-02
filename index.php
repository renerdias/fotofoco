<!DOCTYPE html>
<html lang="pt-BR">

  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <title>FotoFoco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- style start -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- Bootstrap-Plus by Rener Dias -->
    <link href="assets/css/bootstrap-plus.css" rel="stylesheet" type="text/css">
    <!-- IconFont Font-awesone CSS -->
    <link href="assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>
  <body>
    <!-- wrapper start -->
    <div class="wrapper" id="wrapper">
      <div class="card">
        <div class="card-header">
          FotoFoco
        </div>
        <div class="card-block">
          <form action="." method="post">
            <div class="row">
              <div class="form-group column col-sm-2">
                <label>Apenas renomear? </label>
                <label class="toggle m-0">
                  <input name="renomear" type="checkbox">
                  <span class="toggle_body">
                    <span class="toggle_switch"></span>
                    <span class="toggle_track">
                      <span class="toggle_bgd"></span>
                      <span class="toggle_bgd toggle_bgd-negative"></span>
                    </span>
                  </span>
                </label>
                <span class="form-control-feedback" style="display: none;"></span>
              </div>
              <div class="form-group column col-sm-2">
                <label>Aplicar logo? </label>
                <label class="toggle m-0">
                  <input name="logo" type="checkbox" checked>
                  <span class="toggle_body">
                    <span class="toggle_switch"></span>
                    <span class="toggle_track">
                      <span class="toggle_bgd"></span>
                      <span class="toggle_bgd toggle_bgd-negative"></span>
                    </span>
                  </span>
                </label>
                <span class="form-control-feedback" style="display: none;"></span>
              </div>
              <div class="form-group column col-sm-2">
                <label>Eliminar duplicidade hash? </label>
                <label class="toggle m-0">
                  <input name="logo" type="checkbox" checked>
                  <span class="toggle_body">
                    <span class="toggle_switch"></span>
                    <span class="toggle_track">
                      <span class="toggle_bgd"></span>
                      <span class="toggle_bgd toggle_bgd-negative"></span>
                    </span>
                  </span>
                </label>
                <span class="form-control-feedback" style="display: none;"></span>
              </div>
            </div>
          <div class="row">
            <div class="form-group col-8">
              <label>Novo Nome</label>
              <input name="prenome" type="text" class="form-control">
            </div>
            <div class="form-group col-4">
              <label>Inicio da Sequência</label>
              <input name="sequencia" type="number" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-4">
              <label>Largura</label>
              <div class="input-group">
                <input name="largura" value="1920" type="text" class="form-control">
                <span class="input-group-addon">px</span>
              </div>
            </div>
            <div class="form-group col-4">
              <label>Altura</label>
              <div class="input-group">
                <input name="altura" value="1080" type="text" class="form-control">
                <span class="input-group-addon">px</span>
              </div>
            </div>
            <div class="form-group col-4">
              <label>Qualidade</label>
              <div class="input-group">
                <input name="qualidade" value="80" type="text" class="form-control">
                <span class="input-group-addon">%</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-12">
              <label>Marque esta opção caso deseje redimensionar imagens menores que as dimensões especificadas acima sejam redimensionadas de forma proporcional as mesmas.</label>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Manter Proporção
              </label>
            </div>
            </div>
          </div>
          <div class="text-right">
          <input type="submit" class="btn btn-primary ml-sm-1  mb-1 mb-sm-0  col-12 col-sm-4" value="Executar">
          </div>


          </form>
        </div>
      </div>


    <?php
    if ($_POST){
        ini_set('max_execution_time', 300);
        //header('Content-Type: text/html; charset=utf-8');
        require_once('ImageToImage.php');

        #Pasta de origem dos arquivos de imagem
        $pathOrigem = './fotos_origem/';
        #Pasta de destino dos arquivos de imagens modificados
        $pathDestino = './fotos_destino/';
        #Define o prenome a ser aplicado a todas a imagens modificadas
        $prenome= $_POST['prenome'];

        #Inicia o contador
        $count= $_POST['sequencia'] ? $_POST['sequencia'] : 1;

        #
        $largura = $_POST['largura'];
        #
        $altura = $_POST['altura'];
        #
        $qualidade = $_POST['qualidade'];

        #
        $aplicarLogo = isset($_POST['logo']);
        #
        $apenasRenomear = isset($_POST['renomear']);
        #
        echo '<ul class="list-group">';

        #Inicia a iteração como o diretório de origem
        $dir = new DirectoryIterator($pathOrigem);

/*
$d = $dir;
#
$arrHash = [];
$hash =  '';
$arq = [];


        foreach ($d as $a) {
            if(!$a->isDot()) {
                # elemento atual é um arquivo
                if($a->isFile()) {
                    $arq[md5_file($pathOrigem . $a->getBasename())] = $pathOrigem . $a->getBasename();
                }
            }
        }
var_dump($arq);
        foreach ($arq as $key => $value) {
echo "$key/$value<br>";
            copy($value, ($pathDestino . $key . '.jpeg'));
        }
*/

        foreach ($dir as $arquivo) {
            # diferente de .. ou .
            if(!$arquivo->isDot()) {
                # elemento atual é um arquivo
                if($arquivo->isFile()) {
                    #Obtém a extensão do arquivo
                    $extensao =  $arquivo->getExtension();
                    #Obtém o nome sem a extensão
                    $nome = $arquivo->getBasename(".$extensao");
                    #Cria novo nome
                    $novoNome = $prenome . " ($count)";// . strtolower($extensao);
                    if($apenasRenomear){
                      copy($pathOrigem . $arquivo->getBasename(), ($pathDestino . $novoNome . '.' . strtolower($extensao)));
                      echo '<li class="list-group-item justify-content-between"><span>Nome Original: ' . $arquivo->getBasename() . "</span><span> ==></span><span> Novo Nome: $novoNome . $extensao</span></li>";
                    } else {

                    /*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

                    #
                    $image = new ImageToImage();
                    #Define caminho para imagem
                    $image->setSourceImage( $pathOrigem . $arquivo->getBasename());
                    #Define nova largura para a imagem
                    $image->setNewWidth($largura);
                    #Define nova altura para a imagem
                    $image->setNewHeight($altura);
                    #CRIAR FUNÇÃO PARA FAZER PROPORÇÃO QUANDO IMGANES MENORES QUE AS SETADAS
                    #image->activeProportion()
                    if ($aplicarLogo){
                      #Define a marca d'água ou logo
                      $image->setWaterMark('./logo-400.png'); // Texto da legenda
                      #Define a posição da marca d'água ou logo
                      $image->setPosition('bottom','right');
                    }
                    #Define o destino da imagem modificada
                    $image->setDestination($pathDestino); // pasta onde quero salvar a imagem
                    #Cria/salva a imagem modificada, informando novo nome e qualidade de 0-100
                    $image->create( $novoNome, $qualidade );
                    #
                    echo '<li class="list-group-item justify-content-between"><span>Nome Original: ' . $arquivo->getBasename() . "</span><span> ==></span><span> Novo Nome: $novoNome." . strtolower($extensao) . "</span></li>";
                  }
                }
            }
            $count++;
        }

        #
        echo '</ul>';
    }
    ?>



    </div>
    <!-- wrapper end -->
    <!-- script start -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- script end -->
  </body>

</html>

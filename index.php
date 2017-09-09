<?php
ini_set('max_execution_time', 300);
    header('Content-Type: text/html; charset=utf-8');
    require_once('ImageToImage.php');

    #Pasta de origem dos arquivos de imagem
    $pathOrigem = './fotos_origem/';
    #Pasta de destino dos arquivos de imagens modificados
    $pathDestino = './fotos_destino/';
    #Define o prenome a ser aplicado a todas a imagens modificadas
    $prenome="Curso de Operador de Escavadeira Hidráulica - 2017";

    #Inicia o contador
    $count=1;    

    #Inicia a iteração como o diretório de origem
    $dir = new DirectoryIterator($pathOrigem);
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
                //rename($arquivo->getBasename(), $novoNome);
                echo "Nome Original: " . $arquivo->getBasename() . " ==> Novo Nome: " . $novoNome . "<br>";
                
                /*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

                #
                $image = new ImageToImage();
                #Define caminho para imagem
                $image->setSourceImage( $pathOrigem . $arquivo->getBasename());
                #Define nova largura para a imagem
                $image->setNewWidth('1920');
                #Define nova altura para a imagem
                $image->setNewHeight('1080');
                #CRIAR FUNÇÃO PARA FAZER PROPORÇÃO QUANDO IMGANES MENORES QUE AS SETADAS
                #image->activeProportion()
                #Define a marca d'água ou logo
                $image->setWaterMark('./logo-400.png'); // Texto da legenda
                #Define a posição da marca d'água ou logo
                $image->setPosition('bottom','right');
                #Define o destino da imagem modificada
                $image->setDestination($pathDestino); // pasta onde quero salvar a imagem
                #Cria/salva a imagem modificada, informando novo nome e qualidade de 0-100
                $image->create( $novoNome, 80 );

            }   
        }
        $count++;
    }
?>

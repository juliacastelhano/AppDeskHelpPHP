<?php 

    session_start();

    // substituir o '#' para '-'
    $titulo = str_replace('#', '-', $_POST['titulo']);
    $categoria = str_replace('#', '-', $_POST['categoria']);
    $descricao = str_replace('#', '-', $_POST['descricao']);
    

    // formatar o array $_POST em uma estrutura de texto, mais simples, p escrever dentro do arquivo
    // PHP_EOL => End Of Line => quebra a linha após cadastrar um chamado => para que cada chamado fique em uma linha
    $texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;


    // fopen() para ABRIR  o arquivo
    // 1 param é o nome do arquivo, pode ser 'txt ou outro q eu posso criar ('hd' de help desk)
    // 2 param => eu quero só abrir o arquivo, fechar, posicionar o curso p escrito no inicio ou final do arquivo
    $arquivo = fopen('arquivo.hd', 'a');



    // fwrite() para ESCREVER no arquivo
    // 1 param => referência ao arquivo que eu abri, armazenei em uma variável
    // 2 param => referência ao que eu quero escrever
    fwrite($arquivo, $texto);


    // fclose() para FECHAR o arquivo
    // PARAM => referência ao arquivo que eu abri
    fclose($arquivo);

    header('Location: abrir_chamado.php');



    



?>
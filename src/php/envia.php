<?php
  if (isset($_POST['submit'])){
    // Recebe dados do formulario
    $quebra_linha = "\n";
    $emailsender = "site@ranchodocomanche.com.br";
    $nomeremetente= "Formulário de contato - SITE";
    $emaildestinatario = "contato@ranchodocomanche.com.br";
    $validacao = $_POST['validacao'];
    $assunto = "Contato Site";
    $mensagem = $_POST['mensagem'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    //Requisitos google reCaptcha
    $secretKey = "6LcJdbgUAAAAANVijvVGXLpy5RJrjTMicqbyWA1F";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $ch = curl_init();
    $timeout = 5; // set to zero for no timeout
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    if($response->success){
      $mensagemHTML =
        '
          Olá Rancho do Comanche,
          Eu me chamo '.$nome.', estou entrando em contato através do site.

          Aqui estão os meus dados para contato:
          E-mail: '.$email.'
          Telefone: '.$telefone.'
          Celular: '.$celular.'

          Eu gostaria de falar sobre:
          '.$assunto.'

          Minha mensagem:
          '.$mensagem.'
          ';

      $headers = "MIME-Version: 1.1".$quebra_linha;
      $headers .= "Content-type: text/plain; charset=UTF-8".$quebra_linha;
      $headers .= "From:" .$emailsender.$quebra_linha;
      $headers .= "Return-Path:" .$emailsender.$quebra_linha;

      $envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r".$emailsender);
      if (isset($envio)) {
        echo "<script>alert('Mensagem enviada com sucesso! Em breve estaremos entrando em contato!');</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../'>";
      }
      else{
        echo "<script>alert('Erro ao tentar enviar a sua mensagem! Por favor tente enviar a sua mensagem diretamente para o nosso email: contato@ranchodocomanche.com.br');</script>";
      }
    }
    else{
      echo "<script>alert('Erro ao tentar enviar a sua mensagem!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../../'>";
    }
  }
?>

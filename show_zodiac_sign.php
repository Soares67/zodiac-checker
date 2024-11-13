<?php include('layouts/header.php'); ?>

<?php
// Receber a data de nascimento enviada pelo formulário
$data_nascimento = $_POST['data_nascimento'] ?? null;

if ($data_nascimento) {
    // Verificar se a data de nascimento está no formato correto
    $dataNascimentoUsuario = DateTime::createFromFormat('d/m/Y', $data_nascimento);
    
    // Validar se a data foi convertida corretamente
    if ($dataNascimentoUsuario && $dataNascimentoUsuario->format('d/m/Y') === $data_nascimento) {
        // Define o ano fixo para comparar apenas o dia e o mês
        $dataNascimentoUsuario->setDate(2000, $dataNascimentoUsuario->format('m'), $dataNascimentoUsuario->format('d'));

        // Carregar o arquivo XML com os dados dos signos
        $signos = simplexml_load_file("signos.xml");

        $signoEncontrado = null;

        // Iterar pelos signos no XML para encontrar o signo correspondente
        foreach ($signos->signo as $signo) {
            $dataInicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
            $dataInicio->setDate(2000, $dataInicio->format('m'), $dataInicio->format('d'));

            $dataFim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
            $dataFim->setDate(2000, $dataFim->format('m'), $dataFim->format('d'));

            // Verificar se a data de nascimento está entre o início e o fim do signo
            if ($dataNascimentoUsuario >= $dataInicio && $dataNascimentoUsuario <= $dataFim) {
                $signoEncontrado = $signo;
                break;
            }
        }

        // Exibir o signo correspondente
        if ($signoEncontrado) {
            echo "<h1 class='text-center'>{$signoEncontrado->signoNome}</h1>";
            echo "<p class='text-center'>{$signoEncontrado->descricao}</p>";
        } else {
            echo "<p class='text-center text-danger'>Signo não encontrado.</p>";
        }
    } else {
        echo "<p class='text-center text-danger'>Data de nascimento inválida. Por favor, use o formato dd/mm/aaaa.</p>";
    }
} else {
    echo "<p class='text-center text-danger'>Data de nascimento não fornecida.</p>";
}
?>

<div class="text-center mt-4">
    <a href="index.php" class="btn btn-secondary">Voltar</a>
</div>

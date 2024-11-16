<?php include('layouts/header.php'); ?>
<script src="assets/js/particles.js"></script>

<!-- Fundo de partículas -->
<div id="particles-js" class="particles-background"></div>

<?php
// Receber a data de nascimento enviada pelo formulário
$data_nascimento = $_POST['data_nascimento'] ?? null;
$signoEncontrado = null;

if ($data_nascimento) {
    // Verificar se a data de nascimento está no formato correto
    $dataNascimentoUsuario = DateTime::createFromFormat('d/m/Y', $data_nascimento);
    
    // Validar se a data foi convertida corretamente
    if ($dataNascimentoUsuario && $dataNascimentoUsuario->format('d/m/Y') === $data_nascimento) {
        // Define o ano fixo para comparar apenas o dia e o mês
        $dataNascimentoUsuario->setDate(2000, $dataNascimentoUsuario->format('m'), $dataNascimentoUsuario->format('d'));

        // Carregar o arquivo XML com os dados dos signos
        $signos = simplexml_load_file("signos.xml");

        // Encontrar o signo correspondente
        foreach ($signos->signo as $signo) {
            $dataInicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
            $dataInicio->setDate(2000, $dataInicio->format('m'), $dataInicio->format('d'));

            $dataFim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
            $dataFim->setDate(2000, $dataFim->format('m'), $dataFim->format('d'));

            // Caso o signo atravesse o final do ano (por exemplo, Capricórnio)
            if ($dataInicio > $dataFim) {
                // Verificar se a data de nascimento está entre o início do signo e o final do ano
                if ($dataNascimentoUsuario >= $dataInicio || $dataNascimentoUsuario <= $dataFim) {
                    $signoEncontrado = $signo;
                    break;
                }
            } else {
                // Verificar se a data de nascimento está entre o início e o fim do signo
                if ($dataNascimentoUsuario >= $dataInicio && $dataNascimentoUsuario <= $dataFim) {
                    $signoEncontrado = $signo;
                    break;
                }
            }
        }
    } 
}
?>

<div class="result-border">
    <div class="result-container" 
        <?php if ($signoEncontrado): ?>
            style="background-image: url('assets/imgs/<?php echo strtolower($signoEncontrado->signoNome); ?>.jpg');"
        <?php endif; ?>
    >
        <div class="result-header">
            <?php
                if ($signoEncontrado) {
                    echo "<h1>{$signoEncontrado->signoNome}</h1>";
                }
            ?>
        </div>
        <div class="result-description">
            <?php
                if ($signoEncontrado) {
                    echo "<p>{$signoEncontrado->descricao}</p>";
                } else {
                    echo "<p class='text-danger'>Data de nascimento inválida ou signo não encontrado.</p>";
                }
            ?>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <a href="index.php" class="btn btn-secondary">Voltar</a>
</div>

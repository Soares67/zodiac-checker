<?php include('layouts/header.php'); ?>
<script src="assets/js/dateFormat.js"></script>
<script src="assets/js/particles.js"></script>

<div class="text-center" >
    <h1 class="my-4 page-title">Descubra seu Signo</h1>

    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-4 form-container">
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="text" id="data_nascimento" name="data_nascimento" required class="form-control input-date" placeholder="dd/mm/aaaa">
        </div>
        <button type="submit" class="btn btn-submit w-100">Consultar</button>
    </form>
</div>
<div id="particles-js" class="particles-background"></div>

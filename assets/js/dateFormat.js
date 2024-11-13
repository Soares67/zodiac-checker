document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('data_nascimento');

    dateInput.addEventListener('input', function () {
        let input = dateInput.value;
        input = input.replace(/\D/g, ''); // Remover todos os caracteres que não são dígitos

        // Formatar a data como "dd/mm/aaaa"
        if (input.length <= 2) {
            input = input.replace(/(\d{2})/, '$1');
        } else if (input.length <= 4) {
            input = input.replace(/(\d{2})(\d{1,2})/, '$1/$2');
        } else {
            input = input.replace(/(\d{2})(\d{2})(\d{1,4})/, '$1/$2/$3');
        }

        dateInput.value = input;
    });
});

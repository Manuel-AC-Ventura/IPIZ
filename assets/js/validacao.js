document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('continuarBtn').addEventListener('click', function() {
    var inputs = document.querySelectorAll('.form1 input');
    var allFilled = Array.from(inputs).every(input => input.value !== '');

    if (allFilled) {
      var emailInput = document.querySelector('.form1 input[type="email"]');
      var numberInput = document.querySelector('.form1 input[type="number"]');

      if (emailInput && !validateEmail(emailInput.value)) {
        alert('Por favor, insira um endereço de e-mail válido.');
        return;
      }

      if (numberInput && isNaN(numberInput.value)) {
        alert('Por favor, insira um número válido.');
        return;
      }

      document.querySelector('.form1').style.display = 'none';
      document.querySelector('.form2').style.display = 'grid';
    } else {
      alert('Por favor, preencha todos os campos antes de continuar.');
    }
  });

  document.getElementById('voltarBtn').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.form2').style.display = 'none';
    document.querySelector('.form1').style.display = 'grid';
  });

  document.getElementById('cadastrarBtn').addEventListener('click', function(event) {
    event.preventDefault();
    var form2Inputs = document.querySelectorAll('.form2 input');
    var allFilled = Array.from(form2Inputs).every(input => input.value !== '');

    document.getElementById('container').submit();
  });
});

function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}
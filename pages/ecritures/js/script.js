const dateEcriture = document.querySelector('input[name="date_ecriture"]');
const numeroPiece = document.querySelector('input[name="numero_piece"]');

const dateCell = document.querySelector('tr td:nth-child(1)');
const pieceCell = document.querySelector('tr td:nth-child(2)');

dateEcriture.addEventListener('change', function() {
  const dateValue = this.value;
  dateCell.innerHTML = '<p style="padding-top:25px">' + dateValue + '</p>';
});

numeroPiece.addEventListener('input', function() {
  const pieceValue = this.value;
  pieceCell.innerHTML = '<p style="padding-top:25px">' + pieceValue + '</p>';
});

$(document).ready(function() {
    var formEcriture = $('#form-ecriture');
    var tableEcriture = $('#table-ecriture tbody');

    $('#add-ecriture-button').click(function(event) {
      event.preventDefault();
  
        var dateEcriture = $('input[name="date_ecriture"]').val();
        var numeroPiece = $('input[name="numero_piece"]').val();
        var cg = $('input[name="cg"]').val();
        var ct = $('input[name="ct"]').val();
        var libelle = $('input[name="libelle"]').val();
        var devise = $('select[name="devise"]').val();
        var montantDevise = $('input[name="montant_devise"]').val();
        var taux = $('input[name="taux"]').val();
        var debit = $('input[name="debit"]').val();
        var credit = $('input[name="credit"]').val();
    
        var newRow = '<tr>' +
                    '<td>' + dateEcriture + '</td>' +
                    '<td>' + numeroPiece + '</td>' +
                    '<td>' + cg + '</td>' +
                    '<td>' + ct + '</td>' +
                    '<td>' + libelle + '</td>' +
                    '<td>' + devise + '</td>' +
                    '<td>' + montantDevise + '</td>' +
                    '<td>' + taux + '</td>' +
                    '<td>' + debit + '</td>' +
                    '<td>' + credit + '</td>' +
                    '</tr>';
    
        tableEcriture.append(newRow);
    
        $('input[name="cg"]').val('');
        $('input[name="ct"]').val('');
        $('input[name="libelle"]').val('');
        $('input[name="montant_devise"]').val('');
        $('input[name="taux"]').val('');
        $('input[name="debit"]').val('');
        $('input[name="credit"]').val('');
    });
});
  

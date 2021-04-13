$(document).ready(function() {
   
    $("#addConsultation").click(function() {
       console.log($("#motif").val() );
        $.post(
            'bdd/database.patient.php', // Un script PHP que l'on va créer juste après
            {
                donnee: $("#motif").val() // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
              
            },

            function(data) {
                if (data == 'Success') {
                    console.log(data);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Consultation Ajouter !',
                        showConfirmButton: false,
                        timer: 3000
                    });

                }

            },

            'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
        );


    });


    $("#poids").keyup(function(){
        console.log('dddd');
        var imc=("#poids").val*("#taille").val
        $("#imc").val(imc);
        $("#imc").css("background-color", "pink");
      });


});
$(document).ready(function() {
   
    $("#addConsultationn").click(function() {
      console.log($("#motif").val()+'dd' );
        $.post(
            './bdd/database.patient.php', // Un script PHP que l'on va créer juste après
            {
                donnee: $("#motif").val() // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
              
            },

            function(data) {
                if (data == 'Success') {
                   // console.log(data);

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


  /*  $("#poids").mouseleave(function(){
        console.log(("#poids").val);
        var poids=parseFloat(("#poids").val);
        var taille=parseFloat(("#taille").val);
        var imc=poids*taille;
        $("#imc").val(imc);
        $("#imc").css("background-color", "pink");
      });*/


});
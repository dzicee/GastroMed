<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Ajouter Patient</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="main-wrapper">

        <?php
        include('header.php');
        ?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Ajouter Patient :</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form>
                        <h4>Informations Patient :</h4>
                            <div class="row card-box border border-info rounded">

                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label>Nom :<span class="text-danger">*</span></label>
                                        <input class="form-control border border-info rounded" type="text" id="nom" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Prénom :</label>
                                        <input class="form-control border border-info rounded" type="text" id="prenom" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label>Né(e) le :</label>
                                        <div class="cal-icon">
                                            <input class="border border-info rounded" type="date" id="daten">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Age :<span class="text-danger">*</span></label>
                                        <input class="form-control border border-info rounded" id="age" type="number">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 ">
                                    <div class="form-group">
                                        <label>Situation Familiale :</label>
                                        <select id="sf" class="form-control select ">
                                            <option value="célibataire">célibataire</option>
                                            <option value="marié">marié</option>
                                            <option value="divorcé">divorcé</option>
                                            <option value="veuf"> veuf</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select" id="sexe">
                                        <label class="gen-label">Sexe :</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Masculain">Masculain
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="féminin">féminin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4>Coordonnées Patient :</h4>
                            <div class="row card-box border border-success Srounded">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Adresse :</label>
                                        <input id="adresse" class="form-control border border-success rounded" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Fonction :</label>
                                        <input id="fonction" class="form-control border border-success rounded" type="text">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile 1 : </label>
                                        <input id="mob1" class="form-control border border-success rounded" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mobile 2 : </label>
                                        <input id="mob2" class="form-control border border-success rounded" type="number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input id="email" class="form-control border border-success rounded" type="email">
                                    </div>
                                </div>
                            </div>
                            <h4>Antécédent :</h4>
                            <div class="row card-box border border-danger rounded">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Médicaux : </label>
                                        <input id="medicaux" class="form-control border border-danger rounded" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Chirurgicaux : </label>
                                        <input id="chir" class="form-control border border-danger rounded" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Antécédent Familliaux : </label>
                                        <input id="famil" class="form-control border border-danger rounded" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Autre : </label>
                                        <input id="autre" class="form-control border border-danger rounded" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">

                                <button type="button" class="btn btn-primary btn-lg submit-btn" id="submit">Ajouter le Patient</button>
                                <p id="resultat"></p>
                            </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="notification-box">
            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="drop-scroll msg-list-scroll" id="msg_list">
                    <ul class="list-box">
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Richard Miles </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item new-message">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">John Doe</span>
                                        <span class="message-time">1 Aug</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>



                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="chat.html">See all messages</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $("#daten").mouseleave(function() {
                var today = new Date();
                var yearr = today.getFullYear();
                var date = new Date($('#daten').val());
                var year = date.getFullYear();
                $('input[id=age]').val(yearr - year);

            });
            $("#submit").click(function() {
                console.log($("#daten").val());
                $.post(
                    'index.php?add', // Un script PHP que l'on va créer juste après
                    {
                        nom: $("#nom").val(), // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                        prenom: $("#prenom").val(),
                        daten: $("#daten").val(),
                        age: $("#age").val(),
                        adresse: $("#adresse").val(),
                        fonction: $("#fonction").val(),
                        email: $("#email").val(),
                        mob1: $("#mob1").val(),
                        mob2: $("#mob2").val(),
                        sf: $("#sf").val(),
                        sexe: $("#sexe input[type='radio']:checked").val(),
                        medicaux: $("#medicaux").val(),
                        chir: $("#chir").val(),
                        famil: $("#famil").val(),
                        autre: $("#autre").val(),


                    },

                    function(data) {

                        if (data == 'Success1') {


                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Patient crée avec succès !',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            window.setTimeout(function() {
                                window.location.href = 'index.php?patient';
                            }, 3000);

                        } else if (data == 'exist1') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur lors de la création',
                                text: '  "Patient Existe " ',
                                timer: 7000
                            });



                        } else if (data == 'vide1') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur, veuillez renseigner les cahmps :',
                                text: ' "Nom", "Prénom" , "Age"',
                                timer: 7000
                            });


                        }


                    },

                    'text' // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
                );


            });

        });
    </script>
</body>


<!-- add-patient24:07-->

</html>
<!DOCTYPE html>
<html lang="en">


<!-- profile22:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Patient</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <?php
    include('header.php');
    ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row justify-content-center m-2 font-weight-bold" style="font-size: 17px;">
                <?php
                $y = $this->user->sql->request('select * from patient where Code_patient=:id', array('id' =>  $_SESSION["current_patient"]))->fetch();

                ?>
                Dossier Patient N° <?php echo  '(# ' . $y['Code_patient']  . ' ) de ' . $y['nom'] . ' ' . $y['prenom'] . ' - ' . $y['sexe'] . ' - ' . $y['age'] . ' ans'; ?>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Menu :</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item active">
                            <a class="nav-link" href="#">| <i class="las la-stethoscope la-lg"></i> Consultation <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                | <i class="las la-file-medical-alt la-lg"></i> Endoscopie
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Endoscopie</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Coloscopie</a>
                            </div>
                        </li>
                        <li class="nav-item active dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                | <i class="las la-biohazard la-lg"></i> Radiologie
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Endoscopie</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Coloscopie</a>
                            </div>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#"><i class="las  la-vials la-lg"></i> Biologie</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">| <i class="las la-pen-alt la-lg"></i> Ordonnance</a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="#">| <i class="las la-file-alt la-lg"></i> Documents</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">| <i class="las la-calendar la-lg"></i> Rendez-Vous</a>
                        </li>
                    </ul>

                </div>
            </nav>
            <div class="row">
                <div class="col-sm-4 col-lg-4">

                    <div id="rr"></div>




                </div>
                <div class="col-sm-8 col-8 text-right m-b-20 m-t-20">
                    <a href="#" class="btn-lg btn btn-warning btn-rounded float-right" id="ajoutC" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> <span style="font-size:15px;font-weight:bold;">Ajouter Consultation</span> </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="blog-view">
                        <article class="blog blog-single-post">
                            <h5 class="blog-title text-center"><i class="las la-sync"> </i> Historique Médical</h5>


                            <?php
                            $data = $this->user->sql->request('select * from consultation where patient=:id  ORDER BY date_consulte DESC LIMIT 5', array('id' => $_SESSION["current_patient"]));
                            ?>

                            <!-- begin table-->
                            <div class="blog-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Motif</th>
                                                        <th>Examens</th>
                                                        <th>Ordonnance</th>

                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while (($p = $data->fetch())) { ?>
                                                        <tr>
                                                            <td> <?php echo $p['date_consulte']; ?></td>
                                                            <td><?php echo $p['motif']; ?></td>
                                                            <td>1545 Dorsey Ln NE, Leland, NC, 28451</td>
                                                            <td><?php echo $p['id_ordonnance']; ?></td>

                                                            <td class="text-right">
                                                                <div class="dropdown dropdown-action">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class=" consulte dropdown-item" href="#"><i class="fa fa-id-card-o  m-r-5"></i> Consulter</a>
                                                                        <a class="dropdown-item" href="edit-patient.html"><i class="fa fa-pencil m-r-5"></i> Editer</a>
                                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Suprimer</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <!--end table-->

                        </article>




                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- AJouter consultation-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content" >

                <div class="modal-body " >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h4 class="card-title text-center"><i class="fa fa-plus"></i> Ajouter une consultation</h4>
                                <form action="#">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Motif</label>
                                        <div class="col-md-9">

                                            <textarea class="form-control border border-info rounded" rows="3" id="motif"></textarea>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <label class="col-md-3   col-form-label">Temp (°C)</label>
                                                <div class="col-md-9 col-lg-6">

                                                    <input class="form-control border border-info rounded" id="temp">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-md-3 col-form-label">Pouls (/min)</label>
                                                <div class="col-lg-6">

                                                    <input class="form-control border border-info rounded" id="pouls">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                        <div class="row align-items-center">
                                        <div class="col-lg-4">
                                                <label class="col-md-3 col-lg-4 col-form-label">Taille (Cm)</label>

                                                <input class="form-control border border-info rounded" type="number" step="0.1" id="taille" value="0" >
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <label class="col-md-3 col-lg-3 col-form-label">Poids(Kg)</label>

                                                        <input class="form-control border border-info rounded" id="poids" type="number" step="0.1" value="0" >
                                                   
                                                    </div>

                                                </div>
                                                <div class="row m-1">
                                                    <img src="assets/img/humain.jpg" alt="">
                                                </div>
                                                <div class="row m-3 align-items-center">
                                                    <div class="col">
                                                        <label class="col-md-3 col-form-label ">IMC</label>

                                                        <input class="form-control border border-info rounded" id="imc"  >
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                            
                                        </div>

                                    </div>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" id="addConsultation">Ajouter</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- AJouter consultation-->

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/patient.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>


<!-- profile23:03-->

</html>
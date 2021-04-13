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
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Menu :</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" >| <i class="las la-stethoscope la-lg"></i> Consultation <span class="sr-only">(current)</span></a>
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
                            <a class="nav-link" href="#"><i class="las  la-vials la-lg" style="color: Tomato;"></i> Biologie</a>
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
                    <h3 class="page-title my-2" style="color: black;"> Consultation :</h3>
                    <div id="rr"></div>




                </div>
                <div class="col-sm-8 col-8 text-right m-b-20 m-t-20">
                    <a href="#" class="btn-lg btn btn-warning btn-rounded float-right" id="ajoutC" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> <span style="font-size:15px;font-weight:bold;" >Ajouter Consultation</span> </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 p-0">
                    <div class="blog-view">
                        <article class="blog blog-single-post">
                            <h5 class="blog-title"><i class="las la-sync"> </i> Historique Médicale :</h5>

                            <!-- begin table-->
                            <div class="blog-content">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-border table-striped custom-table datatable mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> Jennifer Robinson</td>
                                                        <td>35</td>
                                                        <td>1545 Dorsey Ln NE, Leland, NC, 28451</td>
                                                        <td>(207) 808 8863</td>
                                                        <td>jenniferrobinson@example.com</td>
                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="edit-patient.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>



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
                <aside class="col-md-5 col-lg-5">

                    <div class="widget post-widget">
                        <!-- Begin informations-->
                        <h5 class="text-dark text-center"><i class="las la-folder-plus"></i> Informations Patient :</h5>

                        <div class="row">
                            <?php
                            $y = $this->user->sql->request('select * from patient where Code_patient=:id', array('id' =>  $_SESSION["current_patient"]))->fetch();
                            ?>
                            <div class="col-md-12">
                                <ul class="personal-info">
                                    <div class="border border-info rounded p-2">
                                        <h4 class="text-center "><i class="las la-comment"></i> <u>coordonnées</u> </h4>
                                        <li>
                                            <span class="title">Nom :</span>
                                            <span class=""><?php echo $y['nom']; ?></span>
                                        </li>
                                        <li>
                                            <span class="title">Prénom :</span>
                                            <span class=""><?php echo $y['prenom']; ?></span>
                                        </li>
                                        <li>
                                            <span class="title">Age :</span>
                                            <span class=""><?php echo $y['age']; ?> ans</span>
                                        </li>
                                        <li>
                                            <span class="title">Mobile 1 :</span>
                                            <span class=""><?php echo $y['mobile1']; ?></span>
                                        </li>
                                    </div>
                                    <div class="border border-danger rounded p-2 my-2">
                                        <h4 class="text-center"><i class="las la-first-aid"></i> <u>Antécédent</u> </h4>
                                        <li>
                                            <span class="title"> <i class="las la-capsules la-lg"></i> Médicaux :</span>
                                            <span class=""><?php echo $y['Ant_med']; ?></span>
                                        </li>
                                        <li>
                                            <span class="title"> <i class="las la-ambulance la-lg"></i> Chirurgicaux :</span>
                                            <span class=""><?php echo $y['Ant_chir']; ?></span>
                                        </li>
                                        <li>
                                            <span class="title"> <i class="las la-clone la-lg "></i> Familliaux :</span>
                                            <span class=""><?php echo $y['Ant_famil']; ?></span>
                                        </li>
                                        <li>
                                            <span class="title"><i class="las la-medkit la-lg "></i> Autre :</span>
                                            <span class=""><?php echo $y['autre']; ?></span>
                                        </li>

                                    </div>

                                    <li>
                                        <span class="text text-center"><a href="#">Plus . .</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div> <!-- End informations-->


                    <div class="widget search-widget">
                        <h4 class="card-title">Mesure : </h4>
                        <form class="search-form">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>


                </aside>
            </div>
        </div>

    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- AJouter consultation-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
             
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="card-title text-center"><i class="fa fa-plus"></i> Ajouter une consultation</h4>
                            <form action="#">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Motif</label>
                                    <div class="col-md-9">
                                       
                                        <textarea class="form-control"  rows="3" id="motif"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email Address</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control">
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
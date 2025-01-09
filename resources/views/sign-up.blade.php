<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>eTrade || Sign Up</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/vendor/sal.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/vendor/base.css">
    <link rel="stylesheet" href="assets/css/style.min.css">

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('home') }}" class="site-logo"><img src="./assets/images/logo/logo.png"
                            alt="logo" width="100px"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Vous avez déjà un compte?</p>
                        <a href="{{ route('sign_in') }}" class="axil-btn btn-bg-secondary sign-up-btn">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-8"> {{--  offset-xl-2 --}}
                <div class="axil-signin-form-wrap">
                    <div class="container mx-4">
                        <h3 class="title">I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form class="singin-form">
                            <div class="row">
                                <!-- Avatar -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <!-- Nom complet -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nom complet</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            required maxlength="255">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            required maxlength="255">
                                    </div>
                                </div>

                                <!-- Téléphone -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone_number">Téléphone</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                            required maxlength="20">
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address">Adresse</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            required maxlength="255">
                                    </div>
                                </div>

                                <!-- Genre -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="gender">Genre</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Date de naissance -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date de naissance</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Nom de la boutique -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="shop_name">Nom de la boutique</label>
                                        <input type="text" name="shop_name" id="shop_name" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <!-- Mot de passe -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required minlength="8">
                                    </div>
                                </div>

                                <!-- Confirmation du mot de passe -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmation du mot de passe</label>
                                        <input type="password" name="password_confirmation"
                                            id="password_confirmation" class="form-control" required minlength="8">
                                    </div>
                                </div>

                                <!-- Bouton de soumission -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="axil-btn btn-bg-primary submit-btn">Créer le
                                            compte</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/slick.min.js"></script>
    <script src="assets/js/vendor/js.cookie.js"></script>
    <!-- <script src="assets/js/vendor/jquery.style.switcher.js"></script> -->
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/sal.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/counterup.js"></script>
    <script src="assets/js/vendor/waypoints.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ config('app.name') }} || Se connecter</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="E-GALERIA" />
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}" />

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
    <link rel="stylesheet" href="assets/css/style.css">

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4 col-4">
                    <a href="{{ route('home') }}" class="site-logo"><img src="./assets/images/logo/logo-light.png"
                            alt="logo" width="100px"></a>
                </div>
                <div class="col-sm-8 col-8">
                    <div class="singin-header-btn">
                        <p>Vous avez déjà un compte?</p>
                        <a href="{{ route('login') }}" class="axil-btn btn-bg-primary sign-up-btn">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6 mt-4">
                <div class="axil-signin-banner bg_image bg_image--10 shadow-sm">
                    {{-- <h3 class="title">Nous offrons les meilleurs produits</h3> --}}
                </div>
            </div>
            <div class="col-lg-8"> {{--  offset-xl-2 --}}
                <div class="axil-signin-form-wrap">
                    <div class="container container-register">
                        <h3 class="title">Je suis nouveau ici</h3>
                        <p class="b2 mb--55">Entrez vos coordonnées ci-dessous</p>
                        <form class="singin-form" method="POST" action="{{ route('register') }}"
                            enctype="multipart/form-data" id="avatar-form">
                            @csrf
                            @method('POST')

                            <div class="row">
                                <!-- Avatar -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                        @error('avatar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nom complet -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Nom complet</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name') }}" required maxlength="255">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}" required maxlength="255">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Téléphone -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone_number">Téléphone</label>
                                        <input type="text" name="phone_number" id="phone_number"
                                            class="form-control" value="{{ old('phone_number') }}" required
                                            maxlength="20">
                                        @error('phone_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address">Adresse</label>
                                        <input type="text" name="address" id="address" class="form-control"
                                            value="{{ old('address') }}" required maxlength="255">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Genre -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="gender">Genre</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>
                                                Homme</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                Femme</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date de naissance -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date_of_birth">Date de naissance</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            class="form-control" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                               <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="role">Type de compte</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Client</option>
                                            <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Vendeur</option>
                                        </select>
                                        @error('role')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12" id="shop_name_field" style="display: none;">
                                    <div class="form-group">
                                        <label for="shop_name">Nom de la boutique</label>
                                        <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ old('shop_name') }}">
                                    </div>
                                </div>

                                <!-- Mot de passe -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            required minlength="8">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirmation du mot de passe -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirmation du mot de passe</label>
                                        <input type="password" name="password_confirmation"
                                            id="password_confirmation" class="form-control" required minlength="8">
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
    <script>
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const errorElement = document.getElementById('avatar-error');
            errorElement.classList.add('d-none'); // Cache l'erreur par défaut

            if (file) {
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    errorElement.textContent = 'Le fichier doit être une image (JPEG, PNG ou GIF).';
                    errorElement.classList.remove('d-none');
                    e.target.value = ''; // Réinitialise le champ fichier
                } else if (file.size > 2048 * 1024) {
                    errorElement.textContent = 'L\'image ne doit pas dépasser 2 Mo.';
                    errorElement.classList.remove('d-none');
                    e.target.value = ''; // Réinitialise le champ fichier
                }
            }
        });
    </script>
    
    <script>
        // Sélectionner les éléments du DOM
        const roleSelect = document.getElementById('role');
        const shopNameField = document.getElementById('shop_name_field');

        // Fonction pour afficher ou masquer le champ shop_name
        function toggleShopNameField() {
            if (roleSelect.value === 'seller') {
                shopNameField.style.display = 'block'; // Afficher le champ
            } else {
                shopNameField.style.display = 'none'; // Masquer le champ
            }
        }

        // Écouter les changements sur le champ role
        roleSelect.addEventListener('change', toggleShopNameField);

        // Appliquer la logique au chargement de la page (si un rôle est déjà sélectionné)
        document.addEventListener('DOMContentLoaded', toggleShopNameField);
    </script>

    <script>
        // Sélectionner les éléments du DOM
        const roleSelect = document.getElementById('role');
        const shopNameField = document.getElementById('shop_name_field');

        // Fonction pour afficher ou masquer le champ shop_name
        function toggleShopNameField() {
            if (roleSelect.value === 'seller') {
                shopNameField.style.display = 'block'; // Afficher le champ
            } else {
                shopNameField.style.display = 'none'; // Masquer le champ
            }
        }

        // Écouter les changements sur le champ role
        roleSelect.addEventListener('change', toggleShopNameField);

        // Appliquer la logique au chargement de la page (si un rôle est déjà sélectionné)
        document.addEventListener('DOMContentLoaded', toggleShopNameField);
    </script>
</body>

</html>

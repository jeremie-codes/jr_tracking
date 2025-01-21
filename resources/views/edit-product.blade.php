@php
use Illuminate\Support\Facades\Auth;

$client = Auth::user();
@endphp

@extends('layouts.app')

@section('content')
    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Modifier un produit</li>
                            </ul>
                            <h1 class="title">Modifier le produit</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="assets/images/product/product-45.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start My Account Area  -->
        <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp">
                    <div class="axil-dashboard-author">
                        <div class="media">
                            <div class="thumbnail">
                                <img src="{{ $client->avatar ? '/storage/' . $client->avatar : asset('assets/images/product/author1.png') }}"
                                    alt="Hello Annie">
                            </div>
                            <div class="media-body">
                                <h5 class="title mb-0">{{ $client->name }}</h5>
                                <span class="joining-date {{ $client->role == 'customer' ? 'd-none' : '' }}">Boutique :
                                    {{ $client->shop?->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="axil-dashboard-account">
                                <form class="account-details-form" action="{{ route('update_product', $product->id) }}" method="PUT"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Utiliser PUT pour la mise à jour -->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <!-- Afficher l'image actuelle -->
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" class="img-thumbnail mb-2" style="max-width: 200px;">
                                                @endif
                                                @if ($product->image2)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" class="img-thumbnail mb-2" style="max-width: 200px;">
                                                @endif
                                                @if ($product->image3)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image du produit" class="img-thumbnail mb-2" style="max-width: 200px;">
                                                @endif
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="image">Image principale</label>
                                                        <input type="file" name="image" id="image" class="form-control">
                                                        @error('image')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="image2">Image 2</label>
                                                    <input type="file" name="image2" id="image2" class="form-control">
                                                    @error('image2')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="image3">Image 3</label>
                                                    <input type="file" name="image3" id="image3" class="form-control">
                                                    @error('image3')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Nom</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ old('name', $product->name) }}" required autofocus>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="category_id">Catégorie</label>
                                                <select name="category_id" id="category_id" class="form-control" required>
                                                    <option value="">Sélectionnez une catégorie</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="available">Disponible</label>
                                                <select name="available" id="available" class="form-control" required>
                                                    <option value="1" {{ old('available', $product->available) == 1 ? 'selected' : '' }}>
                                                        Actif</option>
                                                    <option value="0" {{ old('available', $product->available) == 0 ? 'selected' : '' }}>
                                                        Inactif</option>
                                                </select>
                                                @error('available')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="price">Prix</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                    value="{{ old('price', $product->price) }}" required>
                                                @error('price')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $product->description) }}</textarea>
                                                @error('description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="Mettre à jour">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Account Area  -->
    </main>

    <script>
         function validateImage(inputId, errorId) {
                const input = document.getElementById(inputId);
                const errorElement = document.getElementById(errorId);

                input.addEventListener('change', function (e) {
                    const file = e.target.files[0];
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
            }

            // Appliquer la validation à chaque champ d'upload
            validateImage('image', 'image-error');
            validateImage('image2', 'image2-error');
            validateImage('image3', 'image3-error');
    </script>
@endsection
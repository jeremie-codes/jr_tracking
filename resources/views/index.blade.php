@extends('layouts.app')

<title>{{ config('app.name') }} | Accueil</title>

@section('content')
<div class="conatiner-fluid content-inner mt-5 pt-5">
  {{-- --}}
    <div class="row">

        <div class="col-md-12 col-lg-12 py-0">
            <div class="row row-cols-1">
              <div class="overflow-hidden">
                <ul class="p-0 m-0 swiper-wrapper list-inline">
                    <li class="swiper-slide col-md-7" data-aos="fade-up" data-aos-delay="700">
                        <div class="card mt-3 me-2">
                            <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-row text-center align-items-center justify-content-between ">
                                <div class="mt-">
                                    <div class="fs-italic">
                                    <h6> Bienvenue</h6>
                                    <div class="text-muted-50 mb-3">
                                        <small>{{ "Jeremie Mianda" }}</small>
                                    </div>
                                    </div>
                                    <div class="card-profile-progress">
                                    <div id="circle-progress-1"
                                        class="circle-progress  circle-progress-basic circle-progress-primary" data-min-value="0"
                                        data-max-value="100" data-value="80" data-type="percent"></div>
                                    <img src="../../assets/images/avatars/01.png" alt="User-Profile"
                                        class="theme-color-default-img img-fluid rounded-circle card-img">
                                    </div>
                                    <div
                                    class="d-flex justify-content-center icon-pill overflow-hidden align-items-center p-0 rounded-pill btn btn-sm btn-light"
                                    style="width: 35px; height: 35px; position: absolute; bottom: 20px; left: 20px; cursor: pointer;">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M17.44 6.2364C17.48 6.30633 17.55 6.35627 17.64 6.35627C20.04 6.35627 22 8.3141 22 10.7114V16.6448C22 19.0422 20.04 21 17.64 21H6.36C3.95 21 2 19.0422 2 16.6448V10.7114C2 8.3141 3.95 6.35627 6.36 6.35627C6.44 6.35627 6.52 6.31632 6.55 6.2364L6.61 6.11654C6.64448 6.04397 6.67987 5.96943 6.71579 5.89376C6.97161 5.35492 7.25463 4.75879 7.43 4.40844C7.89 3.50943 8.67 3.00999 9.64 3H14.35C15.32 3.00999 16.11 3.50943 16.57 4.40844C16.7275 4.72308 16.9674 5.2299 17.1987 5.71839C17.2464 5.81921 17.2938 5.91924 17.34 6.01665L17.44 6.2364ZM16.71 10.0721C16.71 10.5716 17.11 10.9711 17.61 10.9711C18.11 10.9711 18.52 10.5716 18.52 10.0721C18.52 9.5727 18.11 9.16315 17.61 9.16315C17.11 9.16315 16.71 9.5727 16.71 10.0721ZM10.27 11.6204C10.74 11.1509 11.35 10.9012 12 10.9012C12.65 10.9012 13.26 11.1509 13.72 11.6104C14.18 12.0699 14.43 12.6792 14.43 13.3285C14.42 14.667 13.34 15.7558 12 15.7558C11.35 15.7558 10.74 15.5061 10.28 15.0466C9.82 14.5871 9.57 13.9778 9.57 13.3285V13.3185C9.56 12.6892 9.81 12.0799 10.27 11.6204ZM14.77 16.1054C14.06 16.8147 13.08 17.2542 12 17.2542C10.95 17.2542 9.97 16.8446 9.22 16.1054C8.48 15.3563 8.07 14.3774 8.07 13.3285C8.06 12.2897 8.47 11.3108 9.21 10.5616C9.96 9.81243 10.95 9.40289 12 9.40289C13.05 9.40289 14.04 9.81243 14.78 10.5516C15.52 11.3008 15.93 12.2897 15.93 13.3285C15.92 14.4173 15.48 15.3962 14.77 16.1054Z"
                                        fill="currentColor"></path>
                                    </svg>
                                    <input type="file" class="opacity-0 position-absolute" title="choisir une image">
                                    </div>
                                </div>
                                <div class="mt-5 text-center text-muted-50">
                                    <p>La patience paye, le bien mal acquis ne profite jamais et le salaire du péché c'est la mort.
                                    <b>Romain 6:32 </b>
                                    <br> <span class="text-primary">Que Dieu vous bénisse. </span>
                                    </p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </li>

                    <li class="swiper-slide col-md-5" data-aos="fade-up" data-aos-delay="800">
                        <div class="card mt-3 ms-3 pt-0">
                          <div class="card-body pt-2">
                            <div class="fs-italic mb-2">
                                <h6>Taux du jour</h6>
                            </div>
                            <div class="table-responsive border p-0 m-0">
                                <table class="table table-bordered p-0 m-0" style="font-size: 13px">
                                    <thead>
                                        <tr align="center">
                                            <th scope="col">DÉVISE</th>
                                            <th scope="col">ACHAT</th>
                                            <th scope="col">VENTE</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-weight: 500;" align="center">
                                        <tr class="p-1">
                                            <td scope="row">USD</td>
                                            <td>28 500Fc</td>
                                            <td>29 000Fc</td>
                                        </tr>
                                        <tr class="p-1">
                                            <td scope="row">EUR</td>
                                            <td>28 500Fc</td>
                                            <td>29 000Fc</td>
                                        </tr>
                                        <tr class="p-1">
                                            <td scope="row">CFA</td>
                                            <td>28 500Fc</td>
                                            <td>29 000Fc</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </li>
                </ul>
              </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="row">
              <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <h5 class="mb-2">Notification</h5>
                        <div class="mb-2 text-primary">
                            <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.7071 8.79633C18.7071 10.0523 19.039 10.7925 19.7695 11.6456C20.3231 12.2741 20.5 13.0808 20.5 13.956C20.5 14.8302 20.2128 15.6601 19.6373 16.3339C18.884 17.1417 17.8215 17.6573 16.7372 17.747C15.1659 17.8809 13.5937 17.9937 12.0005 17.9937C10.4063 17.9937 8.83505 17.9263 7.26375 17.747C6.17846 17.6573 5.11602 17.1417 4.36367 16.3339C3.78822 15.6601 3.5 14.8302 3.5 13.956C3.5 13.0808 3.6779 12.2741 4.23049 11.6456C4.98384 10.7925 5.29392 10.0523 5.29392 8.79633V8.3703C5.29392 6.68834 5.71333 5.58852 6.577 4.51186C7.86106 2.9417 9.91935 2 11.9558 2H12.0452C14.1254 2 16.2502 2.98702 17.5125 4.62466C18.3314 5.67916 18.7071 6.73265 18.7071 8.3703V8.79633ZM9.07367 20.0608C9.07367 19.5573 9.53582 19.3266 9.96318 19.2279C10.4631 19.1222 13.5093 19.1222 14.0092 19.2279C14.4366 19.3266 14.8987 19.5573 14.8987 20.0608C14.8738 20.5402 14.5926 20.9653 14.204 21.2352C13.7001 21.628 13.1088 21.8767 12.4906 21.9664C12.1487 22.0107 11.8128 22.0117 11.4828 21.9664C10.8636 21.8767 10.2723 21.628 9.76938 21.2342C9.37978 20.9653 9.09852 20.5402 9.07367 20.0608Z"
                                fill="currentColor"></path>
                            </svg>
                            {{ '1' }} En attente
                        </div>
                    </div>

                    <div class="p-0 card-body">
                        <div class="table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead class="text-center">
                                <tr>
                                    <th>Initiateur</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr class="text-center alert alert-primary p-0 border-0">
                                    <td>
                                    Jack daniels
                                    </td>
                                    <td>$14,000</td>
                                    <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="#" class="iq-media-1">
                                          <div class="btn btn-success border btn-sm">Approuver</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                          <div class="btn btn-danger border btn-sm">Désapprouver</div>
                                        </a>
                                        <a href="#" class="iq-media-1">
                                          <div class="btn btn-warning border btn-sm">Annuler</div>
                                        </a>
                                    </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card border" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h5 class="mb-2">Actions récentes</h5>
                    </div>
                    </div>
                    <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table id="basic-table" class="table mb-0 table-striped" role="grid">
                        <thead>
                            <tr>
                            <th>Type d'action</th>
                            <th>Montant</th>
                            <th>Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>Écriture-Entrée</td>
                            <td>14 000 $</td>
                            <td>Il y a 1 heure</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
              </div>

              <div class="col-md-12 col-lg-12">
                <div class="card" data-aos="fade-up" data-aos-delay="500">
                  <div class="card-body">
                      <div class="fs-italic mb-2">
                          <h6>État de la caisse</h6>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-bordered" style="font-size: 13px">
                              <thead>
                              <tr>
                                  <th scope="col">DÉVISE</th>
                                  <th scope="col">SOLDE</th>
                              </tr>
                              </thead>
                              <tbody style="font-weight: 500;">
                              <tr class="">
                                  <td scope="row">USD</td>
                                  <td>28 500$</td>
                              </tr>
                              <tr class="">
                                  <td scope="row">EUR</td>
                                  <td>28 500£</td>
                              </tr>
                              <tr class="">
                                  <td scope="row">CFA</td>
                                  <td>28 500CFA</td>
                              </tr>
                              <tr class="">
                                  <td scope="row">CDF</td>
                                  <td>28 500 FC</td>
                              </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-4">
            <div class="card" data-aos="fade-up" data-aos-delay="600">
                <div class="flex-wrap card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="mb-2">Indicateur Qualitatif Mensuel</h6>
                    </div>

                    <div>
                        {{ "fFévrier" }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-0 profile-dots-pills border-primary"></div>
                        <div class="ms-4" style="font-size: 13px">
                            <b class="mb-1">Manquant</b> <br>
                            <span class="mb-0">00</span>
                        </div>
                    </div>
                    <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-0 profile-dots-pills border-primary"></div>
                        <div class="ms-4" style="font-size: 13px">
                            <b class="mb-1">Dette Non Récuperé</b> <br>
                            <span class="mb-0">00</span>
                        </div>
                    </div>
                    <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-0 profile-dots-pills border-primary"></div>
                        <div class="ms-4" style="font-size: 13px">
                            <b class="mb-1">Manquant</b> <br>
                            <span class="mb-0">00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="500">
                <div class="fs-italic card-header">
                    <h6>Convertisseur de monnaie</h6>
                </div>
                <div class="text-center card-body d-flex justify-content-around mb-0 pb-0">
                    <div>
                        <div class="form-group">
                            <select class="form-select" id="exampleFormControlSelect1">
                            <option selected>USD</option>
                            <option>EUR</option>
                            <option>CFA</option>
                            <option>CDF</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div style="transform: rotateZ(90deg)">
                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.8397 20.1642V6.54639" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M20.9173 16.0681L16.8395 20.1648L12.7617 16.0681" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6.91102 3.83276V17.4505" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M2.8335 7.92894L6.91127 3.83228L10.9891 7.92894" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                    <div class="form-group">
                        <select class="form-select" id="exampleFormControlSelect1">
                            <option selected>CDF</option>
                            <option>EUR</option>
                            <option>CFA</option>
                            <option>USD</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="text-center card-body d-flex justify-content-around pt-0 mt-0 mb-0 pb-0">
                    <div class="form-group p-0" style="width: 45%">
                        <input type="number" value="0" class="form-control">
                    </div>

                    <hr class="hr-vertial p-0 m-0">

                    <div class="form-group p-0" style="width: 45%">
                        <input readonly type="number" value="0" class="form-control">
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center mt-0 justify-content-center pt-0">
                    <button class="btn btn-info btn-sm">Convertir</button>
                </div>
            </div>
        </div>

    </div>
  <!-- Footer Start-->
</div>
@endsection


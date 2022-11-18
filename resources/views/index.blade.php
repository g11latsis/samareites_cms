<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<style>
    body {
        overflow-x: hidden;
        background-color: #f6f9ff;
        /* Hide horizontal scrollbar */
    }

    .upper-header .col-lg-3 img {
        max-width: 113px;
        max-height: auto;
    }

    .upper-header .col-lg-6 img {
        max-width: 93px;
        max-height: auto;
    }

    @media (max-width: 576px) {
        .upper-header .col-lg-6 img {
            max-width: 70px;
            max-height: auto;
        }

        .upper-header .col-lg-6 h4 {
            font-size: 17px;
        }
    }

    .second-header {
        background-color: #ededed;
    }

    .main-section-1,
    .main-section-2 {
        border: solid 2px #f1f1f1;
    }

    .text-content {
        line-height: 26px;
    }

    .footer {
        background-color: #ededed;
    }

    .auth-links {
        font-weight: 700;
        color: #8f8f8f;
        border-radius: 20px
    }

    .auth-links:hover {
        color: #8f8f8f;
        background-color: #e0e0e0;
    }

    .header-text-heading {
        font-weight: 700;
        color: #7a7a7a;
    }

    .text-break {
        word-break: break-all;
    }

    .con-shadow {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    @media (max-width:570px) {
        .main-responsive-img {
            width: auto;
            height: 70px;
        }
    }

    .home-main-login {
        border: solid 1px red;
        border-radius: 7px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    @media (max-width: 991px) {
        .user-stats-login {
            text-align: center;
        }
    }
    .pagination .page-item span {
        color: white;
        background: rgb(150, 26, 26);
        border: solid 1px white;
    }
    .pagination .page-item .page-link {
        color: black;
    }
    .pagination .active .page-link {
        color: white;
        background: rgb(150, 26, 26);
        border: solid 1px white;
    }
    .pagination .disabled span {
        color: white;
        background: white;
        border: solid 1px #dee2e6;
    }
</style>

<body>

    @php

    use App\Models\IndUser as Volunteer;
    use App\Models\Alert;

    if(session()->has('userlogged')){
    $user = Volunteer::find(session('user')->id);
    $alerts = Alert::whereNotNull('desc3')->where("to3", session('user')->id)->where('trashedbyuser',
    null)->orderby('created_at', 'DESC')->get();
    $seen = true;

    foreach ($alerts as $alert) {
    if($alert->seenbyra == false){
    $seen = false;
    }
    }
    }


    @endphp

    {{-- User Profile Modal --}}
    @if (session()->has('userlogged') && session('userlogged') == true)

    <div class="modal fade" id="home-user-profile-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-xl-6 col-md-6 border">

                            <h6>Προσωπικές Πληροφορίες:</h6>

                            <span>Ονοματεπώνυμο:&nbsp <u>{{ $user->name }}</u></span> <br>
                            <span>Πατρώνυμο:&nbsp <u>{{ $user->fname }}</u></span> <br>
                            <span>Μητρόνυμο:&nbsp <u>{{ $user->mname }}</u></span> <br>
                            <span>Ημερομηνία Γέννησης:&nbsp <u>{{ $user->dob }}</u></span> <br>
                            <span>Ημερομηνία Εγγραφής:&nbsp <u>{{ $user->dor }}</u></span> <br>
                            <span>Ημερομηνία Ορκομωσίας:&nbsp <u>{{ $user->doo }}</u></span> <br>
                            <span>Ομάδα Αίματος:&nbsp <u>{{ $user->bloodtype }}</u></span> <br>
                            <span>Εκπαίδευση:&nbsp <u>{{ $user->edu }}</u></span> <br>
                            <span>Σχολή:&nbsp <u>{{ $user->school }}</u></span> <br>
                            <span>Ειδίκότητα:&nbsp <u>{{ $user->spec }}</u></span> <br>
                            <span>Ιδιότητα:&nbsp <u>{{ $user->attr }}</u></span> <br>
                            <span>Βαθμός:&nbsp <u>{{ $user->lvl }}</u></span> <br>
                            <span>Επάγγελμα:&nbsp <u>{{ $user->prof }}</u></span> <br>
                            <span>Φύλο:&nbsp <u>{{ $user->gen }}</u></span> <br>
                            <span>ΑΦΜ:&nbsp <u>{{ $user->vat }}</u></span> <br>
                            <span>ΔΟΥ:&nbsp <u>{{ $user->register }}</u></span> <br>
                            <span>Αριθμός Ταυτότητας:&nbsp <u>{{ $user->idno }}</u></span> <br>
                            <span>Περιοχή:&nbsp <u>{{ $user->region }}</u></span> <br>
                            <span>Αριθμός Μητρώου:&nbsp <u>{{ $user->regno }}</u></span> <br>
                            <span>Εικόνα:&nbsp <u><a href="" data-bs-toggle="modal"
                                        data-bs-target="#user-image-modal">Προβολή</a></u></span> <br>

                        </div>
                        <div class="col-xl-6 col-md-6 border">

                            <h6>Επικοινωνία:</h6>

                            <span>Τηλ. Σταθερό:&nbsp <u>{{ $user->contact }}</u></span> <br>
                            <span>Τηλ. Κινητό:&nbsp <u>{{ $user->tele }}</u></span> <br>
                            <span>E-mail:&nbsp <u>{{ $user->email }}</u></span> <br>

                            <h6 class="mt-3">Πληροφορίες διεύθυνσης:</h6>

                            <span>Οδός - Αριθμός:&nbsp <u>{{ $user->address }}</u></span> <br>
                            <span>Ταχυδρομικός Κώδικας Κώδικας:&nbsp <u>{{ $user->postal }}</u></span> <br>
                            <span>Πόλη:&nbsp <u>{{ $user->city }}</u></span> <br>

                            <h6 class="mt-3">Άλλες πληροφορίες::</h6>

                            <span>Γλώσσες:&nbsp <span><u>{{ $user->languages }}</u></span> <br>
                                <span>ώρες:&nbsp <u>{{ $user->hours }}</u></span> <br>
                                <span>Βραβεία:&nbsp <u>{{ $user->awards }}</u></span> <br>
                                <span>Ποινές:&nbsp <u>{{ $user->penalties }}</u></span> <br>
                                <span>Βιογραφικό:&nbsp <u><a href="" data-bs-toggle="modal"
                                            data-bs-target="#user-cv-modal">Προβολή PDF</a></u></span> <br>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσε</button>
                </div>
            </div>
        </div>
    </div>

    {{-- --}}

    {{-- User Image Modal --}}
    <div class="modal fade" id="user-image-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if (session('user')->img != "")
                    <img src="{{ asset('images/'.session('user')->img) }}" style="max-width: 100%; height: 100%;"
                        alt="">
                    @else
                    <h3 class="text-center text-danger">Καμία εικόνα!</h3>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσε</button>
                </div>
            </div>
        </div>
    </div>
    {{-- --}}

    {{-- User Cv Modal --}}
    <div class="modal fade" id="user-cv-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if (session('user')->cv != "")
                    <iframe src="{{ asset('images/'.session('user')->cv) }}" style="min-width: 100%; min-height: 72vh;"
                        frameborder="0"></iframe>
                    @else
                    <h3 class="text-center text-danger">Καμία Βιογραφικό!</h3>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Κλείσε</button>
                </div>
            </div>
        </div>
    </div>
    {{-- --}}

    {{-- mail modal --}}
    <div class="modal fade" id="home-user-mail-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <div class="text-center text-primary mb-2">
                                <i class="bi bi-envelope-paper" style="font-size: 37px;"></i>
                            </div>
                        </div>
                        @if (count($alerts) > 0)
                        <div class="col-6 d-flex justify-content-end align-items-center">
                            <a href="{{ route('user.delete.alert') }}"><button class="btn btn-danger rounded">Άδειο
                                    Γραμματοκιβώτιο</button></a>
                        </div>
                        @endif
                    </div>
                    @if (count($alerts) > 0)
                    @foreach ($alerts as $alert)
                    @if ($alert->desc3 != "")

                    <div class="alert border rounded-0" role="alert">

                        @if ($alert->from == "admin")
                        <span class="text-dark">{{ $alert->desc3 }}</span> <br>
                        @else
                        <span class="text-dark">{{ $alert->desc3 }}</span> <br>
                        @endif
                        <span class="text-secondary" style="font-size: 11px">
                            @if ($alert->from == "admin")
                            Από τον Κεντρικό Διαχειριστή -
                            @endif
                            {{ $alert->created_at }}</span> <br>

                    </div>

                    @endif
                    @endforeach
                    @else
                    <h4 class="text-danger text-center" style="position: relative; right: 31px;">Δεν βρέθηκαν Εγγραφές.
                    </h4>
                    @endif
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
                </div>
            </div>
        </div>
    </div>
    {{-- --}}

    @endif

    @php
    use App\Models\IndUser;
    use App\Models\rAdmins;
    use App\Models\Admin;
    use App\Models\Service;
    @endphp

    <div class="container">

        <div class="row upper-header mt-2">
            <div class="col-lg-3 col-md-6 col-sm-4 col-4">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.svg') }}" class="main-responsive-img" alt="" srcset="">
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-8 d-flex justify-content-center">
                <img src="{{ asset('images/minilogo-1(2).png') }}" class="main-responsive-img" alt="" srcset="">
                <img src="{{ asset('images/minilogo-2.png') }}" class="main-responsive-img" alt="" srcset="">
                <img src="{{ asset('images/minilogo-3.png') }}" class="main-responsive-img" alt="" srcset="">
                <img src="{{ asset('images/minilogo-4.png') }}" class="main-responsive-img" alt="" srcset="">
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-12 d-flex flex-column text-center">
                <h4 class="text-danger">www.redcross.gr</h4>
                <h4 class="text-danger">www.samarites.gr</h4>
                <h4 class="text-danger">mitroo@samarites.com</h4>
            </div>
        </div>

    </div>

    <div class="container second-header p-3 mt-3 con-shadow">

        <ul class="nav row">
            <div class="col-xl-1 col-sm-3 col-2">
                @if (session()->has('userlogged') && session('userlogged') == true)
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/default_user2.png') }}" alt="" width="32" height="32"
                            class="rounded-circle me-2">
                        <strong></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light text-small shadow" style="">
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal"
                                data-bs-target="#home-user-profile-modal">Προφίλ</a></li>
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal"
                                data-bs-target="#home-user-mail-modal">Γραμματοκιβώτιο</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Αποσύνδεση</a></li>
                    </ul>
                </div>
                @else
                <li class="nav-item">
                    <a class="nav-link auth-links" aria-current="page" href="{{ url('/login') }}">Σύνδεση</a>
                </li>
                @endif
            </div>
            <div class="col-xl-11 col-sm-9 col-10 d-flex justify-content-end">
                <li class="nav-item">
                    <form class="d-flex example" action="{{ route('user.search') }}" method="post" role="search">
                        @csrf
                        <div class="input-group">
                            <select class="form-select mx-2" name="choice" aria-label="Default select example">
                                <option value="1" selected>Εθελοντές</option>
                                <option value="2">Περιφερειακός Διαχειριστής</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <button class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                    </path>
                                </svg>
                            </button>
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                aria-label="Input group example" aria-describedby="basic-addon1">
                        </div>
                    </form>
                </li>
            </div>
        </ul>

    </div>

    <div class="container">

        <div id="carouselExampleControls" class="carousel slide" data-bs-interval="3100" data-bs-ride="carousel">
            <div class="carousel-inner con-shadow">
                <div class="carousel-item active">
                    <img src="https://www.samarites.gr/cache/files/7a196232b9a22e4062821b9e16efa129b90527be.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.samarites.gr/cache/files/4778439c7fcd38f0065840a7f4379601eb606f18.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.samarites.gr/cache/files/d39b108f47de77296a4b0e2e0e7fd1a92e91311c.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.samarites.gr/cache/files/01936a103a7b4e12e45ba8a393e23206582d7852.jpg"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.samarites.gr/cache/files/bf42f310b83fded761b40c7913eee3a97a923efd.jpg"
                        class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>

    @if (session()->has('userlogged') && session('userlogged') == true)

    @php

    $admin = Admin::first();
    $ra = rAdmins::where('region', session('user')->region)->first();
    $services = Service::all();
    $total_region_members = IndUser::where('region', session('user')->region)->count();
    $total_region_services = Service::where('ra_id', $ra->id)->count();
    $hrs = Service::where('ra_id', $ra->id)->get();
    $ttlhrs = 0;
    $user_services = [];
    $user_service = "";

    if(session('user')->part_status == true){
    foreach($services as $service){
    $parts = $service->parts;
    $newParts = explode(',', $parts);
    foreach ($newParts as $newPart) {
    if($newPart == session('user')->id){
    array_push($user_services, $service->id);
    }
    }
    }
    }

    foreach ($hrs as $hr) {
    $ttlhrs = $ttlhrs + $hr->ttlhrs;
    }

    foreach ($user_services as $user_service_single) {
    $user_service = $user_service_single;
    break;
    }

    $user_service = Service::find($user_service);

    @endphp

    @endif

    <div class="container">

        <div class="container pt-4 pb-5 px-5 main-section-1 border-0 bg-white con-shadow">

            @if (session()->has('userlogged') && session('userlogged') == true)

            <div class="row text-content d-flex justify-content-center user-stats-login">

                <div class="col-lg-3 col-md-12 home-main-login px-4 py-3 mx-2">

                    <h4 class="text-danger">Λεπτομέριες</h4>
                    <span class="text-secondary"><u>Πόλη:</u> {{ session('user')->region }}</span> <br>
                    <span class="text-secondary"><u>Διαχειριστής:</u> {{ $admin->name }}</span> <br>
                    <span class="text-secondary"><u>Περιφερειακός Διαχειριστής:</u> {{ $ra->fname }} {{ $ra->lname
                        }}</span>
                    <br>
                    <span class="text-secondary"><u>Σύνολο Εθελοντές:</u> {{ $total_region_members }}</span> <br>
                    <span class="text-secondary"><u>Σύνολο υπηρεσιών:</u> {{ $total_region_services }}</span> <br>
                    <span class="text-secondary"><u>Total Volunteering Hours:</u> {{ $ttlhrs }}</span> <br>

                </div>
                <div class="col-lg-3 col-md-12 home-main-login px-4 py-3 mx-2">

                    <h4 class="text-danger">Η υπηρεσία μου</h4>
                    <span class="text-secondary"><u>Ονοματεπώνυμο:</u> @if($user_service !=null) {{ $user_service->name
                        }}
                        @endif</span> <br>
                    <span class="text-secondary"><u>Περιοχή:</u> @if($user_service !=null) {{ $user_service->region
                        }} @endif</span> <br>
                    <span class="text-secondary"><u>Συνολικές Ώρες:</u> @if($user_service !=null) {{
                        $user_service->ttlhrs
                        }} @endif</span> <br>
                    <span class="text-secondary"><u>Περιφερειακός Διαχειριστής:</u> @if($user_service !=null) {{
                        $ra->fname }} {{
                        $ra->lname }} @endif</span> <br>
                    <span class="text-secondary"><u>Συνολικός αριθμός εθελοντών:</u>
                        @if($user_service !=null)
                        @php
                        $parts = explode(',', $user_service->parts);
                        $ttlV = sizeOf($parts);
                        @endphp
                        {{ $ttlV }}
                    </span> <br>

                    @endif

                </div>
                <div class="col-lg-3 col-md-12 home-main-login px-4 py-3 mx-2">

                    <h4 class="text-danger">Διοίκηση Πόλης</h4>
                    <span class="text-secondary"><u>διαχειριστής:</u> {{ $admin->name }}</span> <br>
                    <span class="text-secondary"><u>E-mail:</u> {{ $admin->email }}</span> <br>
                    <span class="text-secondary"><u>Περιφερειακός Διαχειριστής:</u> {{ $ra->fname }} {{ $ra->lname
                        }}</span> <br>
                    <span class="text-secondary"><u>E-mail:</u> {{ $ra->email }}</span> <br>

                </div>

            </div>

            @endif

            <h3 @if(session()->has('userlogged') && session('userlogged') == true) class="text-dark mt-5 mb-3" @else
                class="text-dark" @endif>Υπηρεσίες</h3>

            @forelse ($all_services as $service)

            @php

            $ttlVlrs = explode(',', $service->parts);
            $ttlVlrs = sizeOf($ttlVlrs);

            if ($service->parts == "") {
            $ttlVlrs = 0;
            }

            @endphp

            <div class="row">

                <hr>

                <div class="col-12">

                    <h5 class="text-danger">{{ $service->name }}</h5>
                    <p class="text-secondary"><span class="fw-bold">Λεπτομέριες: </span>{{ $service->detail }}<br>
                        <span class="fw-bold">Συνολικός αριθμός εθελοντών: </span>{{ $ttlVlrs }} <br>
                        <span class="fw-bold">Συνολικές Ώρες: </span>{{ $service->ttlhrs }} <br>
                        <span class="fw-bold">Περιοχή: </span>{{ $service->region }}
                    </p>

                </div>

                <hr>

            </div>

            @empty

            @endforelse

            <div class="row">

                {{ $all_services->links() }}

            </div>

        </div>

    </div>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script>

        document.querySeletectorAll(".small").forEach(element => {
            element.style.display = "none";
        });

    </script>

</body>

</html>
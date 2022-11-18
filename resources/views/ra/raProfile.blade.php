@extends('admin.layout.main')

@push('title')
Dashboard
@endpush

@section('main')

@php

    use App\Models\Alert;
    $alerts = Alert::where("to2", session('ra')->id)->where('trashedbyra', null)->orderby('created_at', 'DESC')->get();
    $seen = true;

    foreach ($alerts as $alert) {
      if($alert->seenbyra == false){
        $seen = false;
      }
}

@endphp

<div class="container-fluid row">
  <div class="col-xl-2 col-lg-4 d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-2 dash-sidebar"
    style="width: 280px; min-height:100vh;">
    <div class="d-flex justify-content-between">
      <a href="{{ route('ra.dash') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Dashboard</span>
      </a>
      <button style="height: 37px;" class="btn btn-primary toggle-sidebar rounded"><i class="bi bi-arrow-left"></i></button>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="{{ route('ra.dash') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          Πίνακας Ελέγχου
        </a>
      </li>
      <li>
        <a href="{{ route('ra.user') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Εθελοντές
        </a>
      </li>
      <li>
        <a href="{{ route('ra.service') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Υπηρεσίες
        </a>
      </li>
    </ul>
    <hr>
    <div class="row">
      <div class="col-3 d-flex align-items-center">
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('images/default_user2.png') }}" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong></strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style="">
            <li><a class="dropdown-item" href="{{ route('ra.profile', ['id' => session('ra')->id]) }}">Προφίλ</a></li>
            <li><a class="dropdown-item" href="{{ route('ra.logout') }}">Αποσύνδεση</a></li>
          </ul>
        </div>
      </div>
      <div class="col-9">
        {{-- if not seen --}}
        @if($seen == false)

          <a href="" data-bs-toggle="modal" onclick="seenByRa(this)" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;"><span style="top: 15px; padding: 5px;" class="position-absolute start-10 translate-middle bg-danger border border-light rounded-circle"  id="seen-alert-badge">
            <span class="visually-hidden">New alerts</span>
          </span></i></a>

      {{--  --}}
      {{-- if seen --}}
      @else

          <a href="" data-bs-toggle="modal" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;">
          </span></i></a>

      @endif
        {{--  --}}
      </div>
    </div>
  </div>
  <div class="col-xl-10 col-lg-8 col-md-12 con-ad-dash">
    {{-- mail modal --}}
    <div class="modal fade" id="mailmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="{{ route('ra.delete.alert') }}"><button class="btn btn-danger rounded">Άδειο Γραμματοκιβώτιο</button></a>
              </div>
              @endif
            </div>
            @if (count($alerts) > 0)
              @foreach ($alerts as $alert)
                @if ($alert->desc2 != "")
                    
                <div class="alert border rounded-0" role="alert">

                    @if ($alert->from == "admin")
                    <span class="text-dark">{{ $alert->desc2 }}</span> <br>
                    @else
                    <span class="text-dark">{{ $alert->desc2 }}</span> <br>
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
                <h4 class="text-danger text-center" style="position: relative; right: 31px;">Δεν βρέθηκαν Εγγραφές.</h4>
            @endif
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
          </div>
        </div>
      </div>
    </div>
    {{--  --}}
    <button class="btn btn-primary toggle-sidebar rounded"><i class="bi bi-arrow-right"></i></button>
    {{-- View pdf modal --}}
    <div class="modal" tabindex="-1" id="showPdfModal">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <iframe style="min-width: 100%; min-height: 72vh;" id="showPdfModalBody" src="" frameborder="0"></iframe>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top: -178px">
        <div class="container con-ad-pro bg-light">
        @if (session()->has('alert'))
          <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
          <div class="row">
            @if ($ra->img != "")
            <div class="col-lg-4 col-xl-12 border">
              <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                  <img src="{{ asset('images/'.$ra->img) }}" style="max-width: 273px; height:22vh;" alt="">
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                  <h3>{{ $ra->fname }} {{ $ra->lname }}</h3>
                </div>
                <div class="col-12 d-flex justify-content-center mt-1 border-bottom">
                  <h5>Id: {{ $ra->id }}</h5>
                </div>
                <div class="col- mt-3">
                  <h6 class="text-dark text-center"><b>Ώρες τρέχοντος έτους:</b></h6>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες εθελοντισμού τρέχοντος έτους:&nbsp <u>{{ $ra->cyvolunteeringhrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες υγειονομικής περίθαλψης φέτος:&nbsp <u>{{ $ra->cyhealthhrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες διάσωσης φέτος:&nbsp <u>{{ $ra->cyrescuehrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες νοσηλευτικής φέτος:&nbsp <u>{{ $ra->cynursinghrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες κοινωνικής υπηρεσίας φέτος:&nbsp <u>{{ $ra->cysshrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες προπόνησης φέτος:&nbsp <u>{{ $ra->cytraininghrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Εκπαιδευτικές ώρες φέτος:&nbsp <u>{{ $ra->cyeduhrs }}</u></span>
                </div>
                <div class="col- mt-1">
                  <h6 class="text-dark text-center"><b>Ποινικές ρήτρες:</b></h6>
                </div>
                <div class="col-12 text-center">
                  <span>Ημερομηνία:&nbsp <u>{{ $ra->date }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Τύπος:&nbsp <u>{{ $ra->type }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Διάρκεια:&nbsp <u>{{ $ra->duration }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Περιγραφή:&nbsp <u>{{ $ra->desc }}</u></span>
                </div>
                <div class="col-12 d-flex justify-content-center">
                  <div class="dropdown"><span>Εγγραφα:&nbsp
                      @if ($ra->doc != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$ra->doc) }}" onclick="toggleShowPdf(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                    @endif
                  </div></span>
                </div>
              </div>
            </div>
            @else
            <div class="col-xl-4 col-lg-12 border">
              <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                  <h4 class="mt-5 pt-5">Χωρίς εικόνα!</h4>
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                  <h3>{{ $ra->fname }} {{ $ra->lname }}</h3>
                </div>
                <div class="col-12 d-flex justify-content-center mt-1 border-bottom">
                  <h5>Id: {{ $ra->id }}</h5>
                </div>
                <div class="col- mt-3">
                  <h6 class="text-dark text-center"><b>Ώρες τρέχοντος έτους:</b></h6>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες εθελοντισμού τρέχοντος έτους:&nbsp <u>{{ $ra->cyvolunteeringhrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες υγειονομικής περίθαλψης φέτος:&nbsp <u>{{ $ra->cyhealthhrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες διάσωσης φέτος:&nbsp <u>{{ $ra->cyrescuehrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες νοσηλευτικής φέτος:&nbsp <u>{{ $ra->cynursinghrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες κοινωνικής υπηρεσίας φέτος:&nbsp <u>{{ $ra->cysshrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Ώρες προπόνησης φέτος:&nbsp <u>{{ $ra->cytraininghrs }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Εκπαιδευτικές ώρες φέτος:&nbsp <u>{{ $ra->cyeduhrs }}</u></span>
                </div>
                <div class="col- mt-1">
                  <h6 class="text-dark text-center"><b>Ποινικές ρήτρες:</b></h6>
                </div>
                <div class="col-12 text-center">
                  <span>Ημερομηνία:&nbsp <u>{{ $ra->date }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Τύπος:&nbsp <u>{{ $ra->type }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Διάρκεια:&nbsp <u>{{ $ra->duration }}</u></span>
                </div>
                <div class="col-12 text-center">
                  <span>Περιγραφή:&nbsp <u>{{ $ra->desc }}</u></span>
                </div>
                <div class="col-12 d-flex justify-content-center">
                  <div class="dropdown"><span>Εγγραφα:&nbsp
                      @if ($ra->doc != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$ra->doc) }}" onclick="toggleShowPdf(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                    @endif
                  </div></span>
                </div>
              </div>
            </div>
            @endif
            <div class="col-lg-6 col-xl-4 col-md-12 d-flex border profile-sec-center">
              <div class="row">
                <div class="col-12">
                  <h6 class="text-dark"><b>Προσωπικές Πληροφορίες:</b></h6>
                </div>
                <div class="col-12">
                  <span>Ονοματεπώνυμο:&nbsp <u>{{ $ra->fname }}</u></span>
                </div>
                <div class="col-12">
                  <span>Επίθετο:&nbsp <u>{{ $ra->lname }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ημερομηνία Γέννησης:&nbsp <u>{{ $ra->dob }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ομάδα αίματος:&nbsp <u>{{ $ra->bloodgroup }}</u></span>
                </div>
                <div class="col-12">
                  <span>Δότης αίματος:&nbsp <u>{{ $ra->donor }}</u></span>
                </div>
                <div class="col-12">
                  <span>Βαθμός:&nbsp <u>{{ $ra->lvl }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ειδίκότητα:&nbsp <u>{{ $ra->spec }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ιδιότητα:&nbsp <u>{{ $ra->attr }}</u></span>
                </div>
                <div class="col-12">
                  <span>Βαθμός:&nbsp <u>{{ $ra->grade }}</u></span>
                </div>
                <div class="col-12">
                  <span>Φύλο:&nbsp <u>{{ $ra->gen }}</u></span>
                </div>
                <div class="col-12">
                  <span>ΑΦΜ:&nbsp <u>{{ $ra->vat }}</u></span>
                </div>
                <div class="col-12">
                  <span>Δ.O.Y:&nbsp <u>{{ $ra->doy }}</u></span>
                </div>
                <div class="col-12">
                  <span>Αριθμός Ταυτότητας:&nbsp <u>{{ $ra->idno }}</u></span>
                </div>
                {{-- passport --}}
                <div class="col-12">
                  <div class="dropdown"><span>Αριθμός Διαβατηρίου:&nbsp
                      @if ($ra->passport != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$ra->passport) }}" onclick="toggleShowPdf(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                  </div></span>
                </div>
                <div class="col-12">
                  <span>A.M.K.A:&nbsp <u>{{ $ra->amka }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ταυτότητα Μέλους:&nbsp <u>{{ $ra->memberid }}</u></span>
                </div>
                <div class="col-12">
                  <span>Κατάσταση:&nbsp <u>{{ $ra->status1 }}</u> {!! $ra->status2 == 1 ? "<btutton
                      class='badge badge-success'>Active</btutton>" : "<btutton class='badge badge-danger'>Inactive
                    </btutton>" !!}</span>
                </div>
                <h6 class="text-dark"><b>Εθελοντισμός:</b></h6>
                <div class="col-12">
                  <span>Συνολικές ώρες εθελοντισμού:&nbsp <u>{{ $ra->vhrs }}</u></span>
                </div>
                <div class="col-12">
                  <span>Συνολικές ώρες υγειονομικής περίθαλψης:&nbsp <u>{{ $ra->healthcarehrs }}</u></span>
                </div>
                <div class="col-12">
                  <span>Συνολικές ώρες διάσωσης:&nbsp <u>{{ $ra->rescuehrs }}</u></span>
                </div>
                <div class="col-12">
                  <span>Συνολικές ώρες νοσηλείας:&nbsp <u>{{ $ra->nursinghrs }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ώρες κοινωνικής υπηρεσίας:&nbsp <u>{{ $ra->sshrs }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ώρες προπόνησης:&nbsp <u>{{ $ra->traihrs }}</u></span>
                </div>
                <h6><b class="text-dark">Ειδικές γνώσεις:</b></h6>
                <div class="col-12">
                  <span>Διάρκεια:&nbsp <u>{{ $ra->spknow }}</u></span>
                </div>
                <div class="col-12">
                  <div class="dropdown"><span>Κωδικός Πρόσβασης:&nbsp
                      @if ($ra->licenses != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$ra->licenses) }}" onclick="toggleShowPdf(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                  </div></span>
                </div>
                <div class="col-12">
                  <div class="dropdown"><span>Βιογραφικό:&nbsp
                      @if ($ra->cv != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$ra->cv) }}" onclick="toggleShowPdf(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                  </div></span>
                </div>
                <div class="col-12">
                  <span>Περιοχή:&nbsp <u>{{ $ra->region }}</u></span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-4 col-md-12 d-flex border profile-sec-center">
              <div class="row">
                <div class="col-12">
                  <h6 class="text-dark"><b>Πληροφορίες διεύθυνσης:</b></h6>
                </div>
                <div class="col-12">
                  <span>Μόνιμη διεύθυνση:&nbsp <span><u>{{ $ra->address }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ταχυδρομικός Κώδικας:&nbsp <u>{{ $ra->postal }}</u></span>
                </div>
                <div class="col-12">
                  <span>Πόλη:&nbsp <u>{{ $ra->city }}</u></span>
                </div>
                <div class="col-12">
                  <span>Εν ενεργεία στην Πόλη:&nbsp <u>{{ $ra->active }}</u></span>
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Στοιχεία επικοινωνίας:</b></h6>
                  </div>
                  <div class="col-12">
                    <span>Τηλ. Σταθερό:&nbsp <u>{{ $ra->contact }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Τηλ. Κινητό:&nbsp <u>{{ $ra->tele }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>E-mail:&nbsp <u>{{ $ra->email }}</u></span>
                  </div>
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Επίπεδο Εκπαίδευσης:</b></h6>
                  </div>
                  <div class="col-12">
                    <span>Εκπαίδευση:&nbsp <u>{{ $ra->edu }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Σχολή:&nbsp <u>{{ $ra->school }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Πτυχία:&nbsp <u>{{ $ra->degrees }}</u></span>
                  </div>
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Εκπαίδευση ΕΕΣ:</b></h6>
                  </div>
                  <div class="col-12">
                    <span>Ειδικότητα:&nbsp <u>{{ $ra->eacspec }}</u></span>
                  </div>
                  <div class="col-12">
                    <div class="dropdown"><span>Βαθμός:&nbsp
                        @if ($ra->eacdegree != "")
                        <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Επιλογές
                        </a>
                        <ul class="dropdown-menu">
                          <li><a name="{{ asset('images/'.$ra->eacdegree) }}" onclick="toggleShowPdf(this)"
                              class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                    </div></span>
                  </div>
                  <div class="col-12">
                    <span>διάκριση ΕΕΣ:&nbsp <u>{{ $ra->eacdesctin }}</u></span>
                  </div>
                  {{-- eac distinction proof --}}
                  <div class="col-12">
                    <div class="dropdown"><span>ΕΕΣ διάκριση αποδεικτικό:&nbsp
                        @if ($ra->eacdesctinproof)
                        <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Επιλογές
                        </a>
                        <ul class="dropdown-menu">
                          <li><a name="{{ asset('images/'.$ra->eacdesctinproof) }}" onclick="toggleShowPdf(this)"
                              class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                    </div></span>
                  </div>
                  <div class="col-12">
                    <span>Στην εκπαίδευση σύνδεσης:&nbsp <u>{{ $ra->onlinetrai }}</u></span>
                  </div>
                  <div class="col-12">
                    <div class="dropdown"><span>Εκπαιδεύσεις online Βεβαιώσεις σε pdf:&nbsp
                        @if ($ra->onlinetraicert != "")
                        <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Επιλογές
                        </a>
                        <ul class="dropdown-menu">
                          <li><a name="{{ asset('images/'.$ra->onlinetraicert) }}" onclick="toggleShowPdf(this)"
                              class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                    </div></span>
                  </div>
                  <div class="col-12">
                    <span>Άλλες εκπαιδεύσεις στην Online πλατφόρμα της IFRCη:&nbsp <u>{{ $ra->othertrai }}</u></span>
                  </div>
                  <div class="col-12">
                    <div class="dropdown"><span>βεβαιώσεις σε pd:&nbsp
                        @if ($ra->othertraicert != "")
                        <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false">
                          Επιλογές
                        </a>
                        <ul class="dropdown-menu">
                          <li><a name="{{ asset('images/'.$ra->othertraicert) }}" onclick="toggleShowPdf(this)"
                              class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                      @endif
                    </div></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
</div>

@endsection
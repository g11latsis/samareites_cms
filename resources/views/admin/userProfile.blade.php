@extends('admin.layout.main')

@push('title')
RA
@endpush

@section('main')

@php

    use App\Models\Alert;
    $alerts = Alert::where("to1", "admin")->where('trashedbyadmin', null)->orderby('created_at', 'DESC')->get();
    $seen = true;

    foreach ($alerts as $alert) {
      if($alert->seenbyadmin == false){
        $seen = false;
      }
    }

@endphp


<div class="container-fluid row">
  <div class="col-xl-2 col-lg-4 d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-2 dash-sidebar"
    style="width: 280px; min-height:100vh;">
    <div class="d-flex justify-content-between">
      <a href="{{ route('admin.dash') }}"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Dashboard</span>
      </a>
      <button style="height: 37px;" class="btn btn-primary toggle-sidebar2 rounded"><i class="bi bi-arrow-left"></i></button>
    </div>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="{{ route('admin.dash') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          Πίνακας Ελέγχου
        </a>
      </li>
      <li>
        <a href="{{ route('admin.ra') }}" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#table"></use>
          </svg>
          Περιφερειακός Διαχειριστής
        </a>
      </li>
      <li>
        <a href="{{ route('admin.user') }}" class="nav-link active text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Εθελοντές
        </a>
      </li>
      <li>
        <a href="{{ route('admin.service') }}" class="nav-link text-white">
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
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Προφίλ</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Αποσύνδεση</a></li>
          </ul>
        </div>
      </div>
      <div class="col-9">
        {{-- if not seen --}}
        @if($seen == false)

          <a href="" data-bs-toggle="modal" onclick="seenByAdmin(this)" data-bs-target="#mailmodal"><i class="bi bi-envelope" style="font-size: 31px; color:white;"><span style="top: 15px; padding: 5px;" class="position-absolute start-10 translate-middle bg-danger border border-light rounded-circle"  id="seen-alert-badge">
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
                <a href="{{ route('admin.delete.alert') }}"><button class="btn btn-danger rounded">Άδειο Γραμματοκιβώτιο</button></a>
              </div>
              @endif
            </div>
            @if (count($alerts) > 0)
            @foreach ($alerts as $alert)
              @if ($alert->desc1 != "")
                <div class="alert border rounded-0" role="alert">
                  <span class="text-dark">{{ $alert->desc1 }}</span> <br>
                  <span class="text-secondary" style="font-size: 11px">{{ $alert->created_at }}</span> <br>
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
        <div class="modal" tabindex="-1" id="showPdfModal2">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <iframe style="min-width: 100%; min-height: 72vh;" id="showPdfModalBody2" src="" frameborder="0"></iframe>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Update pdf modal --}}
        <div class="modal" tabindex="-1" id="updatePdfModal2">
          <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body d-flex justify-content-center">
                <div class="col-6 mb-3">
                  <form id="updatePdfModalForm2" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="exampleInputEmail1" class="form-label">Ονοματεπώνυμο
                      :</label>
                    <input type="file" name="" id="updatePdfModalBody2" class="form-control" id="exampleInputEmail1"
                      aria-describedby="emailHelp">
                      <a href="">
                        <button class="btn btn-primary rounded mt-4">Υποβολή</button>
                    </a>
                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary rounded" data-bs-dismiss="modal">Κλείσε</button>
              </div>
            </div>
          </div>
        </div>
    <div class="container-fluid" style="margin-top: -180px">
        <div class="container con-ad-pro bg-light">
          @if (session()->has('alert'))
          <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
          <div class="row">
            @if ($user->img != "")
            <div class="col-lg-12 col-xl-4 border">
              <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                  <img src="{{ asset('images/'.$user->img) }}" style="max-width: 273px; height:22vh;" alt="">
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                  <h3>{{ $user->name }}</h3>
                </div>
                <div class="col-12 d-flex justify-content-center mt-1">
                  <h5>Αριθμός Μητρώου: {{ $user->regno }}</h5>
                </div>
              </div>
            </div>
            @else
            <div class="col-lg-12 col-xl-4 border">
              <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                  <h4 class="mt-5 pt-5">Χωρίς εικόνα!</h4>
                </div>
                <div class="col-12 d-flex justify-content-center mt-5">
                  <h3>{{ $user->name }}</h3>
                </div>
                <div class="col-12 d-flex justify-content-center mt-1">
                  <h5>Αριθμός Μητρώου: {{ $user->regno }}</h5>
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
                  <span>Ονοματεπώνυμο:&nbsp <u>{{ $user->name }}</u></span>
                </div>
                <div class="col-12">
                  <span>Πατρώνυμο:&nbsp <u>{{ $user->fname }}</u></span>
                </div>
                <div class="col-12">
                  <span>Μητρόνυμο:&nbsp <u>{{ $user->mname }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ημερομηνία Γέννησης:&nbsp <u>{{ $user->dob }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ημερομηνία Εγγραφής:&nbsp <u>{{ $user->dor }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ημερομηνία Ορκομωσίας:&nbsp <u>{{ $user->doo }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ομάδα Αίματος:&nbsp <u>{{ $user->bloodtype }}</u></span>
                </div>
                <div class="col-12">
                  <span>Εκπαίδευση:&nbsp <u>{{ $user->edu }}</u></span>
                </div>
                <div class="col-12">
                  <span>Σχολή:&nbsp <u>{{ $user->school }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ειδίκότητα:&nbsp <u>{{ $user->spec }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ιδιότητα:&nbsp <u>{{ $user->attr }}</u></span>
                </div>
                <div class="col-12">
                  <span>Βαθμός:&nbsp <u>{{ $user->lvl }}</u></span>
                </div>
                <div class="col-12">
                  <span>Επάγγελμα:&nbsp <u>{{ $user->prof }}</u></span>
                </div>
                <div class="col-12">
                  <span>Φύλο:&nbsp <u>{{ $user->gen }}</u></span>
                </div>
                <div class="col-12">
                  <span>ΑΦΜ:&nbsp <u>{{ $user->vat }}</u></span>
                </div>
                <div class="col-12">
                  <span>ΔΟΥ:&nbsp <u>{{ $user->register }}</u></span>
                </div>
                <div class="col-12">
                  <span>Αριθμός Ταυτότητας:&nbsp <u>{{ $user->idno }}</u></span>
                </div>
                <div class="col-12">
                  <span>Αριθμός Διαβατηρίου:&nbsp <u>{{ $user->passport }}</u></span>
                </div>
                <div class="col-12">
                  <span>Περιοχή:&nbsp <u>{{ $user->region }}</u></span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-xl-4 col-md-12 d-flex border profile-sec-center">
              <div class="row">
                <div class="col-12">
                  <h6 class="text-dark"><b>Άλλες πληροφορίες:</b></h6>
                </div>
                <div class="col-12">
                  <span>Γλώσσες:&nbsp <span><u>{{ $user->languages }}</u></span>
                </div>
                <div class="col-12">
                  <span>ώρες:&nbsp <u>{{ $user->hours }}</u></span>
                </div>
                <div class="col-12">
                  <span>Βραβεία:&nbsp <u>{{ $user->awards }}</u></span>
                </div>
                <div class="col-12">
                  <span>Ποινές:&nbsp <u>{{ $user->penalties }}</u></span>
                </div>
                <div class="col-12">
                  <div class="dropdown"><span>Βιογραφικό:&nbsp
                      @if ($user->cv != "")
                      <a class="text-primary dropdown-toggle rounded" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Επιλογές
                      </a>
                      <ul class="dropdown-menu">
                        <li><a name="{{ asset('images/'.$user->cv) }}" onclick="toggleShowPdf2(this)"
                            class="dropdown-item showpdf" href="#">Προβολή PDF</a></li>
                        <li><a class="dropdown-item" name="cv" id="{{ $user->id }}" data-update="{{ route('user.profile.pdf.helper', ['id' => $user->id]) }}" onclick="toggleUploadPdf2(this)"
                          href="#">Ανέβασμα PDF</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.profile.pdf.delete', ['name' => 'cv', 'id' => $user->id]) }}">Διαγραφή</a></li>
                      </ul>
                      @else
                      :&nbsp<a class="" name="cv" id="{{ $user->id }}" data-update="{{ route('user.profile.pdf.helper', ['id' => $user->id]) }}" onclick="toggleUploadPdf2(this)"
                        href="#">Ανέβασμα PDF</a>
                      @endif
                  </div></span>
                </div>
                <div class="col-12">
                  @if ($user->status == true)
                    <span>Κατάσταση:&nbsp</span><button class="badge badge-success border-0">Ενεργός</button>
                  @else
                    <span>Κατάσταση:&nbsp</span><button class="badge badge-danger border-0">Αδρανής</button>
                  @endif
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Επικοινωνία:</b></h6>
                  </div>
                  <div class="col-12">
                    <span>Τηλ. Σταθερό:&nbsp <u>{{ $user->contact }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Τηλ. Κινητό:&nbsp <u>{{ $user->tele }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>E-mail:&nbsp <u>{{ $user->email }}</u></span>
                  </div>
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Πληροφορίες διεύθυνσης:</b></h6>
                  </div>
                  <div class="col-12">
                    <span>Οδός - Αριθμός:&nbsp <u>{{ $user->address }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Ταχυδρομικός Κώδικας Κώδικας:&nbsp <u>{{ $user->postal }}</u></span>
                  </div>
                  <div class="col-12">
                    <span>Πόλη:&nbsp <u>{{ $user->city }}</u></span>
                  </div>
                </div>
                <div class="col-12 mt-4" style="position: relative; right: 15px;">
                  <div class="col-12">
                    <h6 class="text-dark"><b>Εν ενεργεία στην Πόλη:</b></h6>
                  </div>
                  <div class="col-12">
                    <span><u>{{ $user->active }}</u></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>

  @endsection
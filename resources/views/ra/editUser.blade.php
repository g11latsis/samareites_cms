@extends('admin.layout.main')

@push('title')
RA
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
              <a href="{{ route('ra.user') }}" class="nav-link text-white active">
                <svg class="bi pe-none me-2" width="16" height="16">
                  <use xlink:href="#table"></use>
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
        @if(session()->has('alert'))
        <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('alert') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="add-ra-main">
            <div class="container">
                <h2 class="text-center mb-4">Επεξεργασία εθελοντή</h2>
                    <form action="{{ route('raUser.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field("PUT") }}
                    <div class="row">
                        {{-- personal info --}}
                        <h6><b class="text-dark">Προσωπικές Πληροφορίες:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ονοματεπώνυμο
                                :</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->name }}" @endif>
                            <span class="text-danger">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Πατρώνυμο
                                :</label>
                            <input type="text" name="fName" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->fname }}" @endif>
                            <span class="text-danger">
                                @error('fName')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Μητρόνυμο
                                :</label>
                            <input type="text" name="mName" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->mname }}" @endif>
                            <span class="text-danger">
                                @error('mName')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ημερομηνία Γέννησης
                                :</label>
                            <input type="date" name="dob" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->dob }}" @endif>
                            <span class="text-danger">
                                @error('dob')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ημερομηνία Εγγραφής
                                :</label>
                            <input type="date" name="dor" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->dor }}" @endif>
                            <span class="text-danger">
                                @error('dor')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ημερομηνία Ορκομωσίας
                                :</label>
                            <input type="date" name="doo" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->doo }}" @endif>
                            <span class="text-danger">
                                @error('doo')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ομάδα Αίματος
                                :</label>
                            <input type="text" name="bloodType" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->bloodtype }}" @endif>
                            <span class="text-danger">
                                @error('bloodType')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εκπαίδευση
                                :</label>
                            <input type="text" name="edu" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->edu }}" @endif>
                            <span class="text-danger">
                                @error('edu')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Σχολή
                                :</label>
                            <input type="text" name="school" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->school }}" @endif>
                            <span class="text-danger">
                                @error('school')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ειδίκότητα
                                :</label>
                            <input type="text" name="spec" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->spec }}" @endif>
                            <span class="text-danger">
                                @error('spec')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ιδιότητα
                                :</label>
                            <input type="text" name="attr" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->attr }}" @endif>
                            <span class="text-danger">
                                @error('attr')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βαθμός
                                :</label>
                            <input type="text" name="lvl" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->lvl }}" @endif>
                            <span class="text-danger">
                                @error('lvl')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Επάγγελμα
                                :</label>
                            <input type="text" name="prof" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->prof }}" @endif>
                            <span class="text-danger">
                                @error('prof')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Φύλο
                                :</label>
                            <input type="text" name="gen" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->gen }}" @endif>
                            <span class="text-danger">
                                @error('gen')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">ΑΦΜ
                                :</label>
                            <input type="text" name="vat" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->vat }}" @endif value="{{ old('vat') }}">
                            <span class="text-danger">
                                @error('vat')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">ΔΟΥ
                                :</label>
                            <input type="text" name="register" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->register }}" @endif>
                            <span class="text-danger">
                                @error('register')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Αριθμός Ταυτότητας
                                :</label>
                            <input type="text" name="idNo" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->idno }}" @endif>
                            <span class="text-danger">
                                @error('idNo')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Αριθμός Διαβατηρίου
                                :</label>
                            <input type="text" name="passport" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->passport }}" @endif>
                            <span class="text-danger">
                                @error('passport')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Αριθμός Μητρώου
                                :</label>
                            <input type="text" name="regNo" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->regno }}" @endif>
                            <span class="text-danger">
                                @error('regNo')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Περιοχή
                                :</label>
                            <input type="text" name="region" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->region }}" @endif value="{{ old('region') }}">
                            <span class="text-danger">
                                @error('region')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- address --}}
                        <h6><b class="text-dark">Πληροφορίες διεύθυνσης:</b></h6>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Οδός - Αριθμός
                                :</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->address }}" @endif>
                            <span class="text-danger">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ταχυδρομικός Κώδικας
                                :</label>
                            <input type="text" name="postal" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->postal }}" @endif>
                            <span class="text-danger">
                                @error('postal')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Πόλη
                                :</label>
                            <input type="text" name="city" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->city }}" @endif>
                            <span class="text-danger">
                                @error('city')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- contact --}}
                        <h6><b class="text-dark">Επικοινωνία και άλλες πληροφορίες:</b></h6>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Τηλ. Σταθερό
                                :</label>
                            <input type="text" name="contact" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->contact }}" @endif>
                            <span class="text-danger">
                                @error('contact')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Τηλ. Κινητό
                                :</label>
                            <input type="text" name="tele" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->tele }}" @endif>
                            <span class="text-danger">
                                @error('tele')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">E-mail:
                                 </label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->email }}" @endif>
                            <span class="text-danger">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- activness --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Εν ενεργεία στην Πόλη:
                                 </label>
                            <input type="text" class="form-control" name="active" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->active }}" @endif>
                            <span class="text-danger">
                                @error('active')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- languages --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Γλώσσες:
                                 </label>
                            <input type="text" class="form-control" name="langs" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->languages }}" @endif>
                            <span class="text-danger">
                                @error('langs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- hours --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ωρες:
                                 </label>
                            <input type="text" class="form-control" name="hrs" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->hours }}" @endif>
                            <span class="text-danger">
                                @error('hrs')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- awards --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βραβεία:
                                 </label>
                            <input type="text" class="form-control" name="awards" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->awards }}" @endif>
                            <span class="text-danger">
                                @error('awards')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- penalties --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ποινές:
                                 </label>
                            <input type="text" class="form-control" name="penalties" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->penalties }}" @endif>
                            <span class="text-danger">
                                @error('penalties')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- cv --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Βιογραφικό:
                                 </label>
                            <input type="file" class="form-control" name="cv" id="exampleInputEmail1"
                                aria-describedby="emailHelp" @if(isset($user)) value="{{ $user->cv }}" @endif>
                            <span class="text-danger">
                                @error('cv')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- passwords --}}
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Κωδικός Πρόσβασης:
                                 </label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <label for="exampleInputEmail1" class="form-label">Επιβεβαίωση Κωδικού:
                                 </label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="exampleInputEmail1" aria-describedby="emailHelp">
                            <span class="text-danger">
                                @error('password_confirmation')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Εικόνα:
                                </label>
                                <input type="file" style="height: 4.1vh" class="form-control" name="img" id="formFile">
                            </div>
                            <span class="text-danger">
                                @error('img')
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-12 mb-3">
                            <a href="">
                                <button class="btn btn-primary rounded">Υποβολή</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
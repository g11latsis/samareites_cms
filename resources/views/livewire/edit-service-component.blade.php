<div>
    <form action="{{ route('raService.update', $service->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field("PUT") }}
        <div class="row">
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-3">
                    <label for="exampleInputEmail1" class="form-label">Τίτλος
                        :</label>
                    <input type="text" name="name" class="form-control rounded-0" id="exampleInputEmail1"
                        aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->name ?? '' }}" @endif value="{{ old('name') }}">
                    <span class="text-danger">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Αριθμός Μητρώου
                    :</label>
                <input type="text" name="regno" class="form-control rounded-0" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->regno ?? '' }}" @endif value="{{ old('regno') }}">
                <span class="text-danger">
                    @error('regno')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ημερομηνία
                    :</label>
                <input type="date" name="date" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->date }}" @endif value="{{ old('date') }}">
                <span class="text-danger">
                    @error('date')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τύπος
                    :</label>
                <input type="text" name="type" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->type ?? '' }}" @endif value="{{ old('type') }}">
                <span class="text-danger">
                    @error('type')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <div class="form-floating">
                    <textarea class="form-control" id="exp" style="border-radius: 0px;" name="exp" placeholder="Λεπτομέριες" id="floatingTextarea2" style="height: 150px"></textarea>
                    <label for="floatingTextarea2">Λεπτομέριες</label>
                  </div>
                <span class="text-danger">
                    @error('exp')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Οχημα (Εάν υπάρχει)
                    :</label>
                <input type="text" name="veh" class="form-control rounded-0" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->veh ?? '' }}" @endif value="{{ old('veh') }}">
                <span class="text-danger">
                    @error('veh')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τύπος οχήματος (επίσημο, ιδιωτικό)
                    :</label>
                <input type="text" name="vehtype" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->vehtype ?? '' }}" @endif value="{{ old('vehtype') }}">
                <span class="text-danger">
                    @error('vehtype')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Οδηγός οχήματος (αν υπάρχει)
                    :</label>
                <input type="text" name="driver" class="form-control" style="border-radius: 0px;" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->driver ?? '' }}" @endif value="{{ old('driver') }}">
                <span class="text-danger">
                    @error('driver')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <div class="form-floating">
                    <textarea class="form-control" name="desc" id="desc" style="border-radius: 0px;" placeholder="Λεπτομέριες" id="floatingTextarea2" style="height: 150px"></textarea>
                    <label for="floatingTextarea2">Περιγραφή</label>
                  </div>
                <span class="text-danger">
                    @error('desc')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Τόπος
                    :</label>
                <input type="text" name="locus" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->locus ?? '' }}" @endif value="{{ old('locus') }}">
                <span class="text-danger">
                    @error('locus')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρα Έναρξης
                    :</label>
                <input type="text" name="strthrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->strthrs ?? '' }}" @endif value="{{ old('strthrs') }}">
                <span class="text-danger">
                    @error('strthrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρα Λήξης
                    :</label>
                <input type="text" name="endhrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->endhrs ?? '' }}" @endif value="{{ old('school') }}">
                <span class="text-danger">
                    @error('endhrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-6 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Συνολικές ώρες
                    :</label>
                <input type="text" name="ttlhrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->ttlhrs ?? '' }}" @endif value="{{ old('ttlhrs') }}" value="{{ old('ttlhrs') }}">
                <span class="text-danger">
                    @error('ttlhrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Συμμετέχοντες
                    :</label>
                <select name="parts[]" id="example" class="form-control"  multiple="multiple">
                    @foreach ($users as $user)
                 
                        <option value="{{ $user->id }}"
                            @foreach($parts as $part)
                                @if($part == $user->id)
                                selected
                                @endif
                            @endforeach>{{ $user->name }}</option>
                    
                    @endforeach
                  </select>
                  <span class="text-danger">
                    @error('parts')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Ώρες Ανα συμμετέχοντα
                    :</label>
                <input type="text" name="parthrs" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->parthrs ?? '' }}" @endif value="{{ old('parthrs') }}">
                <span class="text-danger">
                    @error('parthrs')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="col-xl-12 col-md-12 mb-3">
                <label for="exampleInputEmail1" class="form-label">Περιοχή
                    :</label>
                <input type="text" name="region" class="form-control"
                    aria-describedby="emailHelp" @if(isset($service)) value="{{ $service->region ?? '' }}" @endif value="{{ old('region') }}">
                <span class="text-danger">
                    @error('region')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            </div>
            <div class="col-12 mb-3">
                <a href="">
                    <button class="btn btn-primary rounded">Υποβολή</button>
                </a>
            </div>
        </form>
        </div>
    @push('script')
    <script>
        $("#exp").val("{{ $service->detail }}");
        $("#desc").val("{{ $service->desc }}");
       
        $(function(){

        $("select").bsMultiSelect();

        });
        
    </script>
    @endpush
    @push('script')
    <script>
        function validate(e){
            var elem = document.getElementById("raUserRegion");
            elem.readonly = true;
            elem.value = "{{ session('ra')->region }}";
        }
    </script>
@endpush
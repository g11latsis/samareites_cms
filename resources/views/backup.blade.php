<h2 class="text-center mb-4">Results</h2>
        
        <div class="service-list">
        
            {{-- List header --}}
            <div class="row text-center border-bottom  border-top py-3">
        
                <div class="col-4">
                    <h5>Name</h5>
                </div>
                <div class="col-4">
                    <h5>Email</h5>
                </div>
                <div class="col-4">
                    <h5>Region</h5>
                </div>
        
            </div>
            {{--  --}}
        
            {{-- list body --}}
            @foreach ($results as $result)
                
                <div class="row text-center text-secondary border-bottom py-3 text-break">
        
                    <div class="col-4">
                        @if ($type == 1)
                            {{ $result->name }}
                        @else
                            {{ $result->fname }}  {{ $result->lname }}
                        @endif
                    </div>
                    <div class="col-4">
                        {{ $result->email }}
                    </div>
                    <div class="col-4">
                        {{ $result->region }}
                    </div>
        
                </div>
        
            @endforeach
            {{--  --}}
        
        </div>
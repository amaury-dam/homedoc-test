
@extends('doctor/coreMenu')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <h1 style="text-align: center; margin-top: 90px; color: #0083ca">Espace Médecin
                <i><img style="width: 10%;" src="{{url('ressources/doctor.png')}}"></i></h1>
        </div>
        <div style="margin-top: 90px;"></div>
        @foreach ($items as $key => $item)
            <div class="feed-rss card" onclick="location.href='/doctor/feeds/{{ $key }}';" style="cursor: pointer;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img style="width: 100%;" src="/ressources/logo-petit.png">
                        </div>
                        <div class="col-md-10">
                            <h4>{{ $item->get_title() }}</h4>
                            <div class="news-footer">
                                <ul class="list-inline">
                                    <li>
                                        <i class="fas fa-user"></i>
                                        {{ $item->get_author()->get_name() }}
                                    </li>
                                    <li>
                                        <i class="far fa-calendar-alt"></i>
                                        {{ date('d/m/Y' , strtotime($item->get_date())) }}
                                    </li>
                                </ul>
                                <div>
                                    <ul class="list-inline">
                                        @if (count((array)$item->get_categories()) != 0)
                                            @foreach ($item->get_categories() as $category)
                                                <li class="list-inline-item">
                                                    <i class="fas fa-hashtag"></i>
                                                    {{$category->get_label()}}
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        @endforeach
    </div>

@endsection

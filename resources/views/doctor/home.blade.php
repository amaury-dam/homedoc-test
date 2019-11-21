
@extends('doctor/coreMenu')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 style="text-align: center; margin-top: 90px; color: #0083ca">Espace Médecin
            <i><img style="width: 10%;" src="{{url('ressources/doctor.png')}}"></i></h1>
        </div>
        <div class="container">
            <div style="margin-top: 90px;"></div>
            <div class="card">
                <div class="card-body">
                    <h3>{{ $item->get_title() }}</h3>
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
                    <hr>
                    <div class="feed">{!!  html_entity_decode(htmlentities($item->get_content())) !!}</div>
                    <a href="{{ $item->get_link() }}" class="btn btn-dark">Lire</a>
                </div>






            </div>
        </div>
    </div>
    </div>

@endsection

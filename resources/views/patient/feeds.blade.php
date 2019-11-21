
@extends('patient/coreMenu')

@section('content')

    <div class="container">
        <div style="margin-top: 90px;"></div>
        <nav class="nav nav-tabs mb-3">
            <a class="nav-item nav-link active" href="#p1" data-toggle="tab">Google News</a>
            <a class="nav-item nav-link" href="#p2" data-toggle="tab">Medium</a>
        </nav>
        <div class="tab-content">
            <div class="tab-pane active" id="p1">
                @foreach ($items as $key => $item)
                    <div class="feed-rss card" onclick="location.href='{{ $item->get_link() }}';" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="https://logo.clearbit.com/{{ str_replace(['http://www.', 'https://www.'], '', $item->get_item_tags('','source')[0]['attribs']['']['url']) }}">
                                </div>
                                <div class="col-md-10">
                                    <h4>{{ $item->get_title() }}</h4>
                                    <div class="news-footer">
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fas fa-user"></i>
                                                {{  $item->get_item_tags('','source')[0]["data"] }}
                                            </li>
                                            <li>
                                                <i class="far fa-calendar-alt"></i>
                                                {{ date('d/m/Y' , strtotime($item->get_date())) }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav class="text-center">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="/patient/feeds/{{ $page - 1 }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/patient/feeds/{{ $page + 1 }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane" id="p2">
                @foreach ($mediumItems as $key => $item)
                    <div class="feed-rss card" onclick="location.href='{{ $item->get_link() }}';" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="w-100" src="/ressources/logo-petit.png">
                                </div>
                                <div class="col-md-10">
                                    <h4>{{ $item->get_title() }}</h4>
                                    <div class="news-footer">
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fas fa-user"></i>
                                                {{  $item->get_author()->get_name() }}
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
        </div>
    </div>


@endsection

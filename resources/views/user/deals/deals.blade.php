@extends('layouts/app')

@section('style')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset("assets/css/cabinet.css") }}">
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('inc.message')

            <div class="flex justify-between items-center gap-4">
                <h1 class="text-lg font-medium text-gray-900 uppercase">Мои бронирования</h1>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">

                <button class="accordion">Заявки</button>
                <div class="panel">
                    @if ($deals->contains('status_id', 1))
                        @foreach($deals as $deal)
                            @if ($deal->status_id === 1)
                                <div class="rent-section shadow">

                                    <x-deals-card :deal="$deal"></x-deals-card>

                                    <div class="flex items-center gap-4 cabinet-index-btn">
                                        <form method="post" action="{{ route('user.deals.destroy', $deal) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button :type="'submit'" class="index-del-btn">
                                                <span class="index-btn-span">Удалить заявку</span>
                                            </x-primary-button>
                                        </form>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    @else
                        <p>У вас нет заявок на аренду</p>
                    @endif
                </div>

                <button class="accordion">Актуальное</button>
                    <div class="panel">
                        @if ($deals->contains('status_id', 2))
                            @foreach($deals as $deal)
                                @if ($deal->status_id === 2)
                                    <div class="rent-section shadow">

                                        <x-deals-card :deal="$deal"></x-deals-card>

                                        <div class="flex items-center gap-4 cabinet-index-btn">
                                            <form method="post" action="{{ route('review.create') }}">
                                                @csrf
                                                <input type="hidden" name="property_id" value="{{ $deal->property->id }}">
                                                <x-primary-button :type="'submit'" class="index-rev-btn"><span class="index-btn-span">Оставить отзыв</span>
                                                </x-primary-button>
                                            </form>
                                        </div>

                                        <div class="flex items-center gap-4 cabinet-index-btn">
                                            <x-primary-button>
                                                <a href="{{ route('properties.show', $deal->property) }}">Забронировать повторно</a>
                                            </x-primary-button>

                                        </div>



                                    </div>
                               @endif
                            @endforeach
                        @else
                            <p>Сейчас у вас нет подтверждённых заявок или действующего бронирования</p>
                        @endif
                    </div>

                <button class="accordion">Архив</button>
                <div class="panel">
                        @if ($deals->contains('status_id', 3) || $deals->contains('status_id', 4))
                            @foreach($deals as $deal)
                                @if($deal->status_id === 3 || $deal->status_id === 4)
                                    <div class="rent-section shadow">

                                        <x-deals-card :deal="$deal"></x-deals-card>

                                        <div class="flex items-center gap-4 cabinet-index-btn">
                                            <form method="post" action="{{ route('review.create') }}">
                                                @csrf
                                                <input type="hidden" name="property_id" value="{{ $deal->property->id }}">
                                                <x-primary-button :type="'submit'" class="index-rev-btn"><span class="index-btn-span">Оставить отзыв</span>
                                                </x-primary-button>
                                            </form>
                                        </div>

                                        <div class="flex items-center gap-4 cabinet-index-btn">
                                            <x-primary-button>
                                                <a href="{{ route('properties.show', $deal->property) }}">Забронировать повторно</a>
                                            </x-primary-button>
                                        </div>
                                    </div>
                               @endif
                            @endforeach
                        @else
                            <p>У вас пока нет отклонённых или завершённых бронирвоаний</p>
                        @endif
                    </div>

                <button class="accordion">Отзывы</button>
                <div class="panel">
                    <p>Вы пока не оставляли отзывы.</p>
                    <!--
                    <div class="review-body">

                        <div class="review-header">
                            <div class="review-data">
                                <h6>Название, адрес
                                </h6>
                            </div>
                            <p class="dates">дата размещения/обновления</p>
                        </div>

                        <div class="review-data">
                            <p class="dates"> Даты проживания:дата заезда – дата выезда</p>
                            <div class="stars">
                                <i id="star1" class="fas fa-star"></i>
                                <i id="star2" class="fas fa-star"></i>
                                <i id="star3" class="fas fa-star"></i>
                                <i id="star4" class="fas fa-star"></i>
                                <i id="star5" class="fas fa-star"></i>
                            </div>
                        </div>

                        <p>Описание</p>
                        <hr>

                    </div>-->

                </div>

                </div>
            </div>
        </div>
        <x-scroll-to-top-button></x-scroll-to-top-button>
  </div>
@endsection
@section('script')
    @parent
    <script src="{{ asset("assets/js/cabinet.js") }}"></script>
@endsection

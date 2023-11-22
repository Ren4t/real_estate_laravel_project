@if($property->deal)

    <div class="sm:max-w-2xl" style="width: 100%; max-width: 50rem; margin: 0 0 0 10px;
            box-shadow: 0px 0px 14px 9px rgba(34, 60, 80, 0.2);">

        <div class="tab">

            <button class="tablinks defaultOpen" onclick="openTab(event,
                                            'NewDeals{{$property->id}}', {{$property->id}})">
                Новые заявки
            </button>

            <button class="tablinks" onclick="openTab(event, 'DealsInProgress{{$property->id}}',
                                            {{$property->id}})">
                Действующие заявки
            </button>

            <button class="tablinks" onclick="openTab(event, 'Archive{{$property->id}}',
                                            {{$property->id}})">
                Архив
            </button>

            <button class="tablinks" onclick="openTab(event, 'dealsDates{{$property->id}}',
                                            {{$property->id}})">
                Календарь
            </button>

            <button class="tablinks" onclick="openTab(event, 'dealsMessages{{$property->id}}',
                                            {{$property->id}})">
                Сообщения
            </button>

        </div>

        {{--ДЕЙСТВУЮЩИЕ ЗАЯВКИ--}}

        <div id="DealsInProgress{{$property->id}}" class="tabcontent tabcontent{{$property->id}}">
            <h3>Действующие заявки</h3>

            <div class="table-responsive">

                <table class="table table-striped table-sm" style="min-width: 300px!important;">
                    <thead>
                    <tr>

                        <th scope="col">Дата начала</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Количество гостей</th>
                        <th scope="col">Контакты</th>
                        <th scope="col">Действия</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($property->deal as $item)
                        @if($item->status_id === 2)
                            <tr style="text-align: center!important">
                                <td style="text-align: center!important">{{$item->rent_starts_at}}</td>
                                <td style="text-align: center!important">{{$item->rent_ends_at}}</td>
                                <td style="text-align: center!important">{{$item->guests}}</td>
                                <td style="text-align: center!important; padding:20px 5px">{{$item->tenant->phone}}</td>
                                <td style="display: flex">

                                    <form style="margin: 0 15px 5px;" method="POST" enctype="multipart/form-data"
                                          action="#">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-sm" style="color: red; text-decoration: underline", type="submit">
                                            Завершить
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @else
                            @if($loop->last)
                                <tr>
                                    <td colspan="6">Нет заявок</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{--<div style="padding-right: 65px">
                    {{ $categories->links() }}
                </div>--}}
            </div>

        </div>

        {{--НЕПОДТВЕРЖДЕННЫЕ/НОВЫЕ ЗАЯВКИ--}}

        <div id="NewDeals{{$property->id}}" class="tabcontent tabcontent{{$property->id}}">
            <h3>Новые заявки</h3>
            <div class="table-responsive">

                <table class="table table-striped table-sm" style="min-width: 300px!important;">
                    <thead>
                    <tr>

                        <th scope="col">Дата начала</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Количество гостей</th>
                        <th scope="col">Контакты</th>
                        <th scope="col">Действия</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($property->deal as $item)
                        @if($item->status_id === 1)
                            <tr style="text-align: center!important">
                                <td style="text-align: center!important">{{$item->rent_starts_at}}</td>
                                <td style="text-align: center!important">{{$item->rent_ends_at}}</td>
                                <td style="text-align: center!important">{{$item->guests}}</td>
                                <td style="text-align: center!important; padding:20px 5px">{{$item->tenant->phone}}</td>
                                <td style="display: flex">

                                    <form style="margin: 0 15px 5px;" method="POST" enctype="multipart/form-data"
                                          action="#">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-sm" style="color: red; text-decoration: underline", type="submit">
                                            Подтвердить
                                        </button>
                                    </form>

                                    <form style="margin: 0 15px 5px;" method="POST" enctype="multipart/form-data"
                                          action="#">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-sm" style="color: red; text-decoration: underline", type="submit">
                                            Отклонить
                                        </button>

                                    </form>

                                </td>
                            </tr>
                        @else
                            @if($loop->last)
                                <tr>
                                    <td colspan="6">Нет заявок</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{--<div style="padding-right: 65px">
                    {{ $categories->links() }}
                </div>--}}
            </div>

        </div>

        {{--АРХИВ ЗАЯВОК--}}

        <div id="Archive{{$property->id}}" class="tabcontent tabcontent{{$property->id}}">
            <h3>Архив</h3>

            <div class="table-responsive">

                <table class="table table-striped table-sm" style="min-width: 300px!important;">
                    <thead>
                    <tr>

                        <th scope="col">Дата начала</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Количество гостей</th>
                        <th scope="col">Контакты</th>
                        {{--                            <th scope="col">Действия</th>--}}

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($property->deal as $item)
                        @if($item->status_id === 3 || $item->status_id === 4)
                            <tr style="text-align: center!important">
                                <td style="text-align: center!important">{{$item->rent_starts_at}}</td>
                                <td style="text-align: center!important">{{$item->rent_ends_at}}</td>
                                <td style="text-align: center!important">{{$item->guests}}</td>
                                <td style="text-align: center!important; padding:20px 5px">{{$item->tenant->phone}}</td>
                            </tr>
                        @else
                            @if($loop->last)
                                <tr>
                                    <td colspan="6">Нет заявок</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{--<div style="padding-right: 65px">
                    {{ $categories->links() }}
                </div>--}}
            </div>


        </div>
        {{--Календарь--}}
        <div id="dealsDates{{$property->id}}" class="tabcontent tabcontent{{$property->id}}">
            <h3>Календарь занятости</h3>
            <p> Здесь отображаются действующие и архивные бронирования</p>
            <input id="datepicker{{$property->id}}" hidden />
        </div>

        <div id="dealsMessages{{$property->id}}" class="tabcontent tabcontent{{$property->id}}">
            <h3>Сообщения</h3>
        </div>

    </div>
@else

    <h1 class="notDealsText">У этого объекта пока нет заявок</h1>

@endif




<script>
    function openTab(evt, tabName, propertyId) {
        let i, tabcontent, tablinks, defaultOpen;
        tabcontent = document.getElementsByClassName(`tabcontent${propertyId}`);
        console.log(tabcontent);
        for(i = 0; i < tabcontent.length; i++){
            tabcontent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        evt.currentTarget.className += " active";
    }
    defaultOpen=document.getElementsByClassName("defaultOpen");
    for (let i = 0; i < defaultOpen.length; i++) {
        defaultOpen[i].click();
    }
    /* let dealPopUP = document.querySelectorAll(".dealModalWindow");
     const dealLinkPopUP = document.querySelectorAll('.showDeals');
     document.addEventListener('DOMContentLoaded', () => {
         dealPopUP.forEach((popUp) => {
          popUp.style.display = 'none';
         });
     });
     dealLinkPopUP.forEach((link) => {
         link.addEventListener('click', () => {
             let id = link.dataset.deal;
             let dealPopUPClass = document.querySelector(`.dealModalElement${id}`);
             if(dealPopUPClass.style.display == "block") {
                 dealPopUPClass.style.display="none";
             } else {
                 dealPopUPClass.style.display="block";
             }
         })
     })*/
    {{--Скрипт календаря--}}
    const DateTime{{$property->id}} = easepick.DateTime;
    books{{$property->id}} = [];
    bookedDates{{$property->id}} = [];
    @foreach($property->deal as $item)
        @if($item->status_id === 2 || $item->status_id === 4)
        startat = new Date("{{$item->rent_starts_at}}");
    startat = startat.getFullYear() + "-" + (startat.getMonth() + 1).toString().padStart(2, "0") + "-" + startat.getDate().toString().padStart(2, "0");

    endat = new Date("{{$item->rent_ends_at}}");
    endat = endat.getFullYear() + "-" + (endat.getMonth() + 1).toString().padStart(2, "0") + "-" + endat.getDate().toString().padStart(2, "0");
    booksmini = [startat,endat];
    //console.log(booksmini);
    books{{$property->id}}.push(booksmini);
    //console.log(books);
    bookedDates{{$property->id}} = books{{$property->id}}.map(d => {
        if (d instanceof Array) {
            const startat = new DateTime{{$property->id}}(d[0], 'YYYY-MM-DD');
            const endat = new DateTime{{$property->id}}(d[1], 'YYYY-MM-DD');

            return [startat, endat];
        }
    });
    @endif
    @endforeach

    const picker{{$property->id}} = new easepick.create({
        element: document.getElementById('datepicker{{$property->id}}'),
        zIndex: 10,
        lang: "ru-RU",
        grid: 2,
        calendars: 2,
        inline: true,
        css: [
            href="{{ asset("assets/css/object.css") }}",
            'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
            'https://easepick.com/css/demo_hotelcal.css',
        ],
        plugins: ["AmpPlugin", 'LockPlugin', "KbdPlugin"],
        LockPlugin: {
            minDate: new Date(),
            minDays: 2,
            inseparable: true,
            filter(date, picked) {
                if (picked.length === 1) {
                    const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                    return !picked[0].isSame(date, 'day') && date.inArray(bookedDates{{$property->id}}, incl);
                }
                return date.inArray(bookedDates{{$property->id}}, '[)');
            },
        },
        AmpPlugin: {
            dropdown: {
                months: true,
                years: true,
                minYear: 2023,
                maxYear: 2030
            }
        }
    })

</script>

<div>
    @if(auth()->user()->role->hasPermissions('show-admin-monitoring'))

        <div class="intro-y box  mt-5 grid grid-cols-12 gap-6 mt-5 mx-auto" style="display:flex;">
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-sm font-medium p-4 ml-auto">
                    آمار عضویت کاربران فروشگاه در سال {{ $year }}
                </h2>
            </div>
            <div class="p-5"  id="line-chart" style="width: 100%;">
                <div class="preview">
                    <canvas id="users" height="150" ></canvas>
                </div>
            </div>
        </div>

        <div class="intro-y box  mt-5 grid grid-cols-12 gap-6 mt-5 mx-auto" style="display:flex;">
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-sm font-medium p-4 ml-auto">
                    آمار فروش موفق محصول بر اساس مبلغ در سال {{ $year }}
                </h2>
            </div>
            <div class="p-5"  id="line-chart" style="width: 100%;">
                <div class="preview">
                    <canvas id="payments" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="intro-y box  mt-5 grid grid-cols-12 gap-6 mt-5 mb-5 mx-auto" style="display:flex;">
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-sm font-medium p-4 ml-auto">
                    آمار فروش موفق محصول بر اساس تعداد در سال {{ $year }}
                </h2>
            </div>
            <div class="p-5"  id="line-chart" style="width: 100%;">
                <div class="preview">
                    <canvas id="products" height="150"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.0/chart.min.js"></script>

        <script>

                Chart.defaults.font.family = 'Vazir';

                const labels = ['اسفند' , 'بهمن' , 'دی' , 'آذر' , 'آبان' , 'مهر' , 'شهریور' , 'مرداد' , 'تیر' , 'خرداد' ,'اردیبهشت' ,'فروردین'];
                const label = ['فروردین' , 'اردیبهشت' , 'خرداد' , 'تیر' , 'مرداد' , 'شهریور' , 'مهر'
                    , 'آبان' , 'آذر' , 'دی' , 'بهمن' , 'اسفند'];

                const usersCTX = document.getElementById('users').getContext('2d');
                const users = new Chart(usersCTX, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'عضویت کاربران',
                            data: [
                                @foreach($users as $user)
                                @php
                                    echo $user . ',';
                                @endphp
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(143, 159, 64, 0.2)' ,
                                'rgba(201, 222, 64, 0.2)' ,
                                'rgba(178, 247, 64, 0.2)' ,
                                'rgba(215, 009, 64, 0.2)' ,
                                'rgba(255, 159, 64, 0.2)' ,
                                'rgba(102, 005, 56, 0.2)' ,
                                'rgba(111, 169, 64, 0.2)' ,
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)' ,
                                'rgba(201, 222, 64, 0.2)' ,
                                'rgba(178, 247, 64, 0.2)' ,
                                'rgba(215, 009, 64, 0.2)' ,
                                'rgba(255, 159, 64, 0.2)' ,
                                'rgba(102, 005, 56, 0.2)' ,
                                'rgba(111, 169, 64, 0.2)' ,
                            ],
                            borderWidth: 1 ,
                            base : 0
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }

                    }
                });

                const paymentsCTX = document.getElementById('payments').getContext('2d');
                const payments = new Chart(paymentsCTX, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'فروش محصول',
                            data: [
                                @foreach($payments as $pay)
                                @php
                                    echo $pay . ',';
                                @endphp
                                @endforeach
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(143, 159, 64, 0.2)' ,
                                'rgba(201, 222, 64, 0.2)' ,
                                'rgba(178, 247, 64, 0.2)' ,
                                'rgba(215, 009, 64, 0.2)' ,
                                'rgba(255, 159, 64, 0.2)' ,
                                'rgba(102, 005, 56, 0.2)' ,
                                'rgba(111, 169, 64, 0.2)' ,
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)' ,
                                'rgba(201, 222, 64, 0.2)' ,
                                'rgba(178, 247, 64, 0.2)' ,
                                'rgba(215, 009, 64, 0.2)' ,
                                'rgba(255, 159, 64, 0.2)' ,
                                'rgba(102, 005, 56, 0.2)' ,
                                'rgba(111, 169, 64, 0.2)' ,
                            ],
                            borderWidth: 1 ,
                            base : 0
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }

                    }
                });

                const productsCTX = document.getElementById('products').getContext('2d');
                const genericOptions = {
                    fill: false,
                    interaction: {
                        intersect: false
                    },
                    radius: 0,
                };
                const skipped = (ctx, value) => ctx.p0.skip || ctx.p1.skip ? value : undefined;
                const down = (ctx, value) => ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;
                const products = new Chart(productsCTX, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'فروش کالا بر حسب تعداد',
                            data: [
                                @foreach($SaleByProduct as $product)
                                @php
                                    echo $product . ',';
                                @endphp
                                @endforeach
                            ],
                            borderColor: 'rgb(75, 192, 192)',
                            segment: {
                                borderColor: ctx => skipped(ctx, 'rgb(0,0,0,0.2)') || down(ctx, 'rgb(192,75,75)'),
                                borderDash: ctx => skipped(ctx, [6, 6]),
                            },
                            spanGaps: true ,
                        }]
                    },
                    options: genericOptions
                });


            </script>

    @endif

    @if(auth()->user()->role->hasPermissions('show-user-monitoring'))
        <div class="BoxInfo">
            <div class="BoxInfoItem mt-5">
                <p>تعداد خرید</p>
                <div>
                    <p>{{ $countOrder }}</p>
                </div>
            </div>
            <div class="BoxInfoItem mt-5">
                <p>جمع خرید</p>
                <div>
                    <span class="rial">{{ $countBuy }}</span>
                    <span>تومان</span>
                </div>
            </div>
            <div class="BoxInfoItem mt-5">
                <p>بارگیری شده</p>
                <div>
                    <p>{{ $countTransOk }}</p>
                </div>
            </div>

            <div class="BoxInfoItem mt-5">
                <p>تحویل گرفته شده</p>
                <div>
                    <p>{{ $countTransFull }}</p>
                </div>
            </div>
        </div>
        @endif
        <button onclick="window.print()" class="button text-white bg-theme-1 shadow-md ml-2 mt-5 pt-3">Print</button>
    @push('script')
        var Numbers = document.querySelectorAll('.rial');
        for (var i = 0 ; i < Numbers.length ; i++){
            Number = Numbers[i].innerText;
            Number = Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z= x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
            y= y.replace(rgx, '$1' + ',' + '$2');
            Numbers[i].innerHTML = '';
            Numbers[i].innerHTML = y;
        }
    @endpush

</div>

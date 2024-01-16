@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{__("Dashboard")}}
    </h2>
    @include('admin.message')
    @if(isset($dataUser->userReferralCode()->referral_code))
        <div class="bravo-user-chart">
            <div class="chart-title text-center" style="margin-bottom: 0px !important;">
                {{__("Kode Referral")}}
            </div>
            <p class="text-center">Bagikan kode referralmu dan dapatkan penawaran menarik</p>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-2">
                        <input type="text" class="form-control" value="{{ isset($dataUser->userReferralCode()->referral_code)?$dataUser->userReferralCode()->referral_code:'-' }}" disabled style="text-align: center;" id="input-kode-referal-dashboard">
                        <div class="row mt-1">
                            <div class="col-md-6 mt-1">
                                <button class="btn btn-info mr-1 btn-block" type="button" id="button-copy-kode-referal-dashboard" onclick="copyToClipboardDashboard('{!! isset($dataUser->userReferralCode()->referral_code)?$dataUser->userReferralCode()->referral_code:'-' !!}')" data-toggle="tooltip" data-placement="bottom" title="Copy Kode Referal">
                                    <i class="fa fa-copy"></i> Copy
                                </button>
                            </div>
                            <div class="col-md-6 mt-1">
                                <button class="btn btn-success btn-block" type="button" id="button-share-kode-referal-dashboard" onclick="shareToWhatsappDashboard('{!! isset($dataUser->userReferralCode()->referral_code)?url('refferal/'.$dataUser->userReferralCode()->referral_code):'-' !!}')" data-toggle="tooltip" data-placement="bottom" title="Share Kode Referal">
                                    <i class="fa fa-share"></i> Bagikan
                                </button>
                            </div>    
                        </div>  
                    </div> 
                </div>
            </div> 
        </div>
    @endif
    <div class="bravo-user-dashboard">
        <div class="row dashboard-price-info row-eq-height">
            @if(!empty($cards_report))
                @foreach($cards_report as $item)
                    <div class="col-lg-3 col-md-3">
                        <div class="dashboard-item">
                            <div class="wrap-box">
                                <div class="title">
                                    {{$item['title']}}
                                </div>
                                <div class="details">
                                    <div class="number">
                                        {{ $item['amount'] }}
                                    </div>
                                </div>
                                <div class="desc"> {{ $item['desc'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="bravo-user-chart">
        <div class="chart-title">
            {{__("Earning statistics")}}
            <div class="action-control">
                <div id="reportrange">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
        <canvas class="bravo-user-render-chart"></canvas>
        <script>
            var earning_chart_data = {!! json_encode($earning_chart_data) !!};
        </script>
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="{{ asset("libs/chart_js/Chart.min.js") }}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $(".bravo-user-render-chart").each(function () {
                let ctx = $(this)[0].getContext('2d');
                window.myMixedChartForVendor = new Chart(ctx, {
                    type: 'bar',//line - bar
                    data: earning_chart_data,
                    options: {
                        min:0,
                        responsive: true,
                        legend: {
                            display: true
                        },
                        scales: {
                            xAxes: [{
                                stacked: true,
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Timeline")}}'
                                }
                            }],
                            yAxes: [{
                                stacked: true,
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: '{{__("Currency: :currency_main",['currency_main'=>setting_item('currency_main')])}}'
                                },
                                ticks: {
                                    beginAtZero: true,
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.yLabel + " ({{setting_item('currency_main')}})";
                                    return label;
                                }
                            }
                        }
                    }
                });
            });
            $(".bravo-user-chart form select").change(function () {
                $(this).closest("form").submit();
            });

            var start = moment().startOf('week');
            var end = moment();
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                "alwaysShowCalendars": true,
                "opens": "left",
                "showDropdowns": true,
                ranges: {
                    '{{__("Today")}}': [moment(), moment()],
                    '{{__("Yesterday")}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{__("Last 7 Days")}}': [moment().subtract(6, 'days'), moment()],
                    '{{__("Last 30 Days")}}': [moment().subtract(29, 'days'), moment()],
                    '{{__("This Month")}}': [moment().startOf('month'), moment().endOf('month')],
                    '{{__("Last Month")}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '{{__("This Year")}}': [moment().startOf('year'), moment().endOf('year')],
                    '{{__('This Week')}}': [moment().startOf('week'), end]
                }
            }, cb).on('apply.daterangepicker', function (ev, picker) {
                $.ajax({
                    url: '{{url('user/reloadChart')}}',
                    data: {
                        chart: 'earning',
                        from: picker.startDate.format('YYYY-MM-DD'),
                        to: picker.endDate.format('YYYY-MM-DD'),
                    },
                    dataType: 'json',
                    type: 'post',
                    success: function (res) {
                        if (res.status) {
                            window.myMixedChartForVendor.data = res.data;
                            window.myMixedChartForVendor.update();
                        }
                    }
                })
            });
            cb(start, end);
        });
        function copyToClipboardDashboard(params) {
            var textToCopy = $('input#input-kode-referal-dashboard').val();
            navigator.clipboard.writeText(textToCopy).then(function() {
                $('#button-copy-kode-referal-dashboard').tooltip('hide')
                .attr('data-original-title', 'Copied: ' + params)
                .tooltip('show');
            }).catch(function(err) {
                console.error('Unable to copy text', err);
            });
        }

        function shareToWhatsappDashboard(params) {
            var whatsapp_url = "https://wa.me/?text=" + encodeURIComponent(params);
            window.open(whatsapp_url, '_blank');
        }
    </script>
@endpush

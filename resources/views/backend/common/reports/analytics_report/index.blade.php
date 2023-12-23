@extends('backend.layouts.master')
@section('title', 'Analytics Report')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Sale overview</h6>


                    <p class="text-sm mb-0">

                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold"> {{date('Y')-1}} To </span> {{date('Y')}}

                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Shop Report</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <i class="fas fa-info" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-5 col-12 text-center">
                            <div class="chart mt-5">
                                <canvas id="chart-doughnut" class="chart-canvas" height="200"
                                    style="display: block; box-sizing: border-box; height: 200px; width: 145.1px;"
                                    width="145"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            @for ($i = 0; $i <count($shopLabels); $i++) <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Name: {{($shopLabels[$i])}}</h6>
                                                    </div>
                                                </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold">Q: {{($shopData[$i])}}
                                                    </span>
                                                </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- sale end --}}
    <div class="row mt-1">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Purchase overview</h6>
                    <p class="text-sm mb-0">

                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold"> {{date('Y')-1}} To </span> {{date('Y')}}

                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="purchasechart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="card h-100">
                <h6 class="text-capitalize">Purchase</h6>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="purchdoughnut-chart" class="chart-canvas" height="300px"></canvas>
                    </div>
                </div>
            </div>


        </div>

    </div>
    {{-- purchase end --}}
    <div class="row mt-1">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Daily Sale</h6>
                    <p class="text-sm mb-0">

                        <i class="fa fa-calendar text-success"></i>
                        <span class="font-weight-bold"> Opening To </span> {{date('d-m-Y')}}

                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="dailysale-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>


        </div>

    </div>
 {{-- daily sale end --}}
    <div class="row mt-1">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Loss Profit</h6>
                    <p class="text-sm mb-0">

                        <i class="fa fa-calendar text-success"></i>
                        <span class="font-weight-bold"> Opening To </span> {{date('d-m-Y')}}

                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="lossprofit-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>


        </div>

    </div>


</div>

@endsection
@push('js')

<script src="{{ asset('backend/assets/js/plugins/chartjs.min.js') }}"></script>
<script>
    $(document).ready(function () {

     // for sale
       var ctx1 = document.getElementById("chart-line").getContext("2d");
       var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
       currentyeardata=@json(($currentYear));
       previewyear=@json(($previewYear));
       var previousYears = {
            Jan : previewyear[1],
            Feb: previewyear[2],
            Mar: previewyear[3],
            Apr: previewyear[4],
            May: previewyear[5],
            Jun: previewyear[6],
            Jul: previewyear[7],
            Aug: previewyear[8],
            Sep: previewyear[9],
            Oct: previewyear[10],
            Nov: previewyear[11],
            Dec: previewyear[12]
       };
       var currentdateHash = {
            Jan : currentyeardata[1],
            Feb: currentyeardata[2],
            Mar: currentyeardata[3],
            Apr: currentyeardata[4],
            May: currentyeardata[5],
            Jun: currentyeardata[6],
            Jul: currentyeardata[7],
            Aug: currentyeardata[8],
            Sep: currentyeardata[9],
            Oct: currentyeardata[10],
            Nov: currentyeardata[11],
            Dec: currentyeardata[12]
      };



        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

        new Chart(ctx1, {
            data: {
            datasets: [{
            type: "bar",
            label: "Previous Year",
            weight: 5,
            tension: 0.4,
            borderWidth: 0,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            backgroundColor: '#3A416F',
            borderRadius: 4,
            borderSkipped: false,
            data:previousYears,
            maxBarThickness: 10,
          },
          {
            type: "line",
            label: "Current Year",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            pointBackgroundColor: "#5e72e4",
            borderColor: "#5e72e4",
            borderWidth: 3,
            backgroundColor:gradientStroke1 ,
            data:currentdateHash,
            fill: true,
          }
        ],

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        //for shop
var ctx2 = document.getElementById("chart-doughnut").getContext("2d");

var shoplabels =@json(($shopLabels));
var shopvalues =@json(($shopData));
var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors
 // Doughnut chart
 new Chart(ctx2, {
      type: "doughnut",
      data: {
        labels: shoplabels,
        datasets: [{
         weight: 9,
          cutout: 60,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#5e72e4'],
          data: shopvalues,
          fill: false
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });

//for purchase

var pctx1 = document.getElementById("purchasechart-line").getContext("2d");
       var pgradientStroke1 = pctx1.createLinearGradient(0, 230, 0, 50);
       purchasecurrentyeardata=@json(($purchaseCurrentYear));
       purchasepreviewyear=@json(($purchasePreviewYear));
       var purchasepreviousYears = {
            Jan : purchasepreviewyear[1],
            Feb: purchasepreviewyear[2],
            Mar: purchasepreviewyear[3],
            Apr: purchasepreviewyear[4],
            May: purchasepreviewyear[5],
            Jun: purchasepreviewyear[6],
            Jul: purchasepreviewyear[7],
            Aug: purchasepreviewyear[8],
            Sep: purchasepreviewyear[9],
            Oct: purchasepreviewyear[10],
            Nov: purchasepreviewyear[11],
            Dec: purchasepreviewyear[12]
       };
       var purchasecurrentdateHash = {
            Jan : purchasecurrentyeardata[1],
            Feb: purchasecurrentyeardata[2],
            Mar: purchasecurrentyeardata[3],
            Apr: purchasecurrentyeardata[4],
            May: purchasecurrentyeardata[5],
            Jun: purchasecurrentyeardata[6],
            Jul: purchasecurrentyeardata[7],
            Aug: purchasecurrentyeardata[8],
            Sep: purchasecurrentyeardata[9],
            Oct: purchasecurrentyeardata[10],
            Nov: purchasecurrentyeardata[11],
            Dec: purchasecurrentyeardata[12]
      };



        pgradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        pgradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        pgradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

        new Chart(pctx1, {
            data: {
            datasets: [{
            type: "bar",
            label: "Previous Year",
            weight: 5,
            tension: 0.4,
            borderWidth: 0,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            backgroundColor: '#3A416F',
            borderRadius: 4,
            borderSkipped: false,
            data:purchasepreviousYears,
            maxBarThickness: 10,
          },
          {
            type: "line",
            label: "Current Year",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            pointBackgroundColor: "#5e72e4",
            borderColor: "#5e72e4",
            borderWidth: 3,
            backgroundColor:pgradientStroke1 ,
            data:purchasecurrentdateHash,
            fill: true,
          }
        ],

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
// Doughnut chart
var ctx3 = document.getElementById("purchdoughnut-chart").getContext("2d");
var shoppurchaselabels =@json(($shopPurchaseLabels));
var shoppurchasevalues =@json(($shopPurchaseData));
new Chart(ctx3, {
        type: "pie",
        data: {
            labels: shoppurchaselabels,
          datasets: [{
           weight: 9,
            cutout: 0,
            tension: 0.9,
            pointRadius: 2,
            borderWidth: 2,
            backgroundColor: ['#17c1e8', '#5e72e4', '#3A416F', '#a8b8d8'],
            data: shoppurchasevalues,
            fill: false
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                display: false
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                display: false,
              }
            },
          },
        },
      });


 // for sale
 var salectx1 = document.getElementById("dailysale-line").getContext("2d");
      dailSaleData=@json(($dailySaleData));
       dailySaleLevel=@json(($dailySaleLabels));


new Chart(salectx1, {
  type: "bar",
  data: {
    labels: dailySaleLevel,
    datasets: [{
      label: "Sales",
      weight: 5,
      borderWidth: 0,
      borderRadius: 4,
      backgroundColor: '#3A416F',
      data: dailSaleData,
      fill: false,
      maxBarThickness: 35
    }],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false,
      }
    },
    scales: {
      y: {
        grid: {
          drawBorder: false,
          display: true,
          drawOnChartArea: true,
          drawTicks: false,
          borderDash: [5, 5]
        },
        ticks: {
          display: true,
          padding: 10,
          color: '#9ca2b7'
        }
      },
      x: {
        grid: {
          drawBorder: false,
          display: false,
          drawOnChartArea: true,
          drawTicks: true,
        },
        ticks: {
          display: true,
          color: '#9ca2b7',
          padding: 10
        }
      },
    },
  },
});

 // for lossprofit


 var lossprofitx = document.getElementById("lossprofit-line").getContext("2d");
       var gradientStroke1 = lossprofitx.createLinearGradient(0, 230, 0, 50);

       dailSaleData=@json(($dailySaleData));
       dailySaleLevel=@json(($dailySaleLabels));
       dailyLossProfit=@json(($lossProfitData));

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

        new Chart(lossprofitx, {
            data: {
                labels: dailySaleLevel,
            datasets: [{
            type: "bar",
            label: "Sale",
            weight: 5,
            tension: 0.4,
            borderWidth: 0,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            backgroundColor: '#3A416F',
            borderRadius: 4,
            borderSkipped: false,
            data:dailSaleData,
            maxBarThickness: 10,
          },
          {
            type: "line",
            label: "Loss profit",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            pointBackgroundColor: "#5e72e4",
            borderColor: "#5e72e4",
            borderWidth: 3,
            backgroundColor:gradientStroke1 ,
            data:dailyLossProfit,
            fill: true,
          }
        ],

            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

    });
</script>
@endpush

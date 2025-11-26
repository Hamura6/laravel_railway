<div>
    <style>
        .neo-card {
            padding: 1.5rem;
            background-color: #f3f4f6;
            background: linear-gradient(145deg, #f0f2f5, #e5e7eb);
            box-shadow:
                -12px -12px 24px #ffffff,
                12px 12px 24px #c1c7d0,
                inset -4px -4px 8px rgba(209, 213, 220, 0.5),
                inset 4px 4px 8px rgba(255, 255, 255, 0.7);
            border-radius: 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%
        }

        .neo-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), transparent);
            pointer-events: none;
            border-radius: 24px;
        }

        .neo-card:hover {
            transform: translateY(-4px);
            box-shadow:
                -16px -16px 32px #ffffff,
                16px 16px 32px #b0b7c5,
                inset -4px -4px 8px rgba(209, 213, 220, 0.5),
                inset 4px 4px 8px rgba(255, 255, 255, 0.7);
        }

        .neo-title {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .neo-title-icon {
            position: relative;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow:
                -3px -3px 6px rgba(255, 255, 255, 0.6),
                3px 3px 6px rgba(0, 0, 0, 0.15),
                inset -1px -1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .neo-title-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            color: white;
            z-index: 1;
        }

        .neo-title-text {
            margin-left: 0.75rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
        }

        .neo-percent {
            margin-left: auto;
            font-size: 0.875rem;
            font-weight: 700;
            color: #059669;
            background: rgba(16, 185, 129, 0.1);
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
        }

        .neo-percent svg {
            width: 0.75rem;
            height: 0.75rem;
            margin-right: 0.25rem;
        }

        .neo-data {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .neo-data-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
            margin: 0;
        }

        .neo-data-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: -0.5rem;
        }

        .neo-progress-container {
            position: relative;
            height: 0.75rem;
            background: linear-gradient(145deg, #d1d5db, #f3f4f6);
            border-radius: 0.375rem;
            overflow: hidden;
            box-shadow:
                inset -2px -2px 4px rgba(255, 255, 255, 0.8),
                inset 2px 2px 4px rgba(163, 177, 198, 0.6);
        }

        .neo-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #34d399);
            border-radius: 0.375rem;
            width: 76%;
            position: relative;
            overflow: hidden;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .neo-progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: translateX(-100%);
            animation: neo-shimmer 2s infinite;
        }

        @keyframes neo-shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .neo-progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }
    </style>
    <div class="row g-3">
     {{--  <input type="text" wire:model.live.debounce="date"> --}}
    {{--   {{ $this->date }} --}}
        <h2 class="py-3">¡Bienvenido al Panel Administrativo!</h2>
        <div class="col-md-6 ">
            <div class="neo-card ">
                <div class="neo-title">
                    <div class="neo-title-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="neo-title-text">Saldo de aporte pendiente</div>
                    <div class="neo-percent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        {{ $result['porcentaje_aportes'] }}%
                    </div>
                </div>

                <div class="neo-data">
                    <p class="neo-data-value">{{ $result['aportes'] }} Bs</p>
                    <p class="neo-data-label my-0">Total adeudado</p>

                    <div class="neo-progress-container">
                        <div class="neo-progress-fill" style="width: {{ $result['porcentaje_aportes'] }}%"></div>
                    </div>

                    <div class="neo-progress-label">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="neo-card">
                <div class="neo-title">
                    <div class="neo-title-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="neo-title-text">Saldo total pendiente</div>
                    <div class="neo-percent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        {{ $result['porcentaje_restante'] }}%
                    </div>
                </div>

                <div class="neo-data">
                    <p class="neo-data-value">{{ $result['total_tramites'] }} Bs</p>
                    <p class="neo-data-label my-0">Total adeudado</p>

                    <div class="neo-progress-container">
                        <div class="neo-progress-fill" style="width: {{ $result['porcentaje_restante'] }}%"></div>
                    </div>

                    <div class="neo-progress-label">
                        <span>0%</span>
                        <span>100%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border border-dark h-100">
                <div class="card-body p-2">
                    <h3>Deuda por tipo de tarifa</h3>
                    <div id="chartFees" style="flex: 1; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border border-dark h-100">
                <div class="card-body p-2">
                    <h3>Deuda por tipo de tarifa</h3>
                    <div id="chartStatus" style="flex: 1; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card border border-dark h-100">
                <div class="card-body p-2">
                    <h3>Aportes por mes del 2025</h3>
                    <div id="chartFeesLine"></div>
                </div>
            </div>
        </div>
    </div>












    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // feesJson ya es JSON, podemos usarlo directamente
        var feesData = {!! $feesJson !!};

        var categories = feesData.map(f => f.name);
        var saldoFinales = feesData.map(f => f.saldo_final);

        var options = {
            chart: {
                type: 'bar',
                height: 400
            },
            series: [{
                name: 'Saldo Final',
                data: saldoFinales
            }],
            xaxis: {
                categories: categories
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartFees"), options);
        chart.render();




        // Datos de estatus desde Laravel
        var estatusData = {!! $estatusJson !!};

        // Labels y valores
        var categories = estatusData.map(e => e.status);
        var totals = estatusData.map(e => e.total);

        // Colores personalizados
        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A'];

        // Configuración del gráfico de pastel mejorada
        var options = {
            chart: {
                type: 'pie',
                height: 400,
                animations: {
                    enabled: true,
                    easing: 'easeout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                },
                toolbar: {
                    show: true, // habilita la barra de herramientas
                    tools: {
                        download: true, // botón de descarga
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false
                    }
                }
            },
            series: totals,
            labels: categories,
            colors: colors,
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 12,
                    height: 12
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    colors: ['#fff']
                },
                dropShadow: {
                    enabled: true,
                    top: 1,
                    left: 1,
                    blur: 1,
                    opacity: 0.45
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " registros";
                    }
                }
            },

            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#chartStatus"), options);
        chart.render();




        var feesData = {!! $totalesJson !!};

        // Extraer categorías y valores
        var categories = feesData.map(f => f.mes); // ["Enero", "Febrero", ...]
        var totals = feesData.map(f => f.total); // [0, 3000, 0, ...]

        // Configuración del gráfico de línea
        var options = {
            chart: {
                type: 'line',
                height: 400,
                toolbar: {
                    show: true, // habilita botones de descarga
                    tools: {
                        download: true,
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false
                    }
                }
            },
            series: [{
                name: 'Total Pagado',
                data: totals
            }],
            xaxis: {
                categories: categories
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + " Bs";
                }
            },
            stroke: {
                curve: 'smooth' // línea suave
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " Bs";
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartFeesLine"), options);
        chart.render();
    </script>




















































    {{--   <div class="d-grid d-md-flex gap-1">
    <button class="btn btn-secondary"
            data-bs-custom-class="custom-tooltip"
            data-bs-placement="top"
            data-bs-title="This top tooltip is themed via CSS variables."
            data-bs-toggle="tooltip"
            type="button">
      Custom tooltip
    </button>
    <button class="btn btn-secondary"
            data-bs-placement="top"
            data-bs-title="Tooltip on top"
            data-bs-toggle="tooltip"
            type="button">
      Tooltip on top
    </button>
    <button class="btn btn-secondary"
            data-bs-placement="right"
            data-bs-title="Tooltip on right"
            data-bs-toggle="tooltip"
            type="button">
      Tooltip on right
    </button>
    <button class="btn btn-secondary"
            data-bs-placement="bottom"
            data-bs-title="Tooltip on bottom"
            data-bs-toggle="tooltip"
            type="button">
      Tooltip on bottom
    </button>
    <button class="btn btn-secondary"
            data-bs-placement="left"
            data-bs-title="Tooltip on left"
            data-bs-toggle="tooltip"
            type="button">
      Tooltip on left
    </button>
  </div>

  <br>

  <button class="btn btn-primary"
          id="liveToastBtn"
          type="button">Show live toast</button>

  <br>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div aria-atomic="true"
         aria-live="assertive"
         class="toast"
         id="liveToast"
         role="alert">
      <div class="toast-header">
        <img alt="..."
             class="me-2 rounded"
             src="...">
        <strong class="me-auto">Bootstrap</strong>
        <small>11 mins ago</small>
        <button aria-label="Close"
                class="btn-close"
                data-bs-dismiss="toast"
                type="button"></button>
      </div>
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
    </div>
  </div>

  <br>

  <button class="btn btn-primary"
          data-bs-target="#exampleModal"
          data-bs-toggle="modal"
          type="button">
    Launch demo modal
  </button>

  <div class="d-grid d-sm-flex my-2 gap-1">
    <button class="btn btn-primary btn-sm"
            onclick="exampleSwalToastSuccess()"
            type="button">exampleSwalToastSuccess</button>
    <button class="btn btn-primary btn-sm"
            onclick="exampleSwalToastError()"
            type="button">exampleSwalToastError</button>
    <button class="btn btn-primary btn-sm"
            onclick="exampleSwalToastWarning()"
            type="button">exampleSwalToastWarning</button>
    <button class="btn btn-primary btn-sm"
            onclick="exampleSwalToastInfo()"
            type="button">exampleSwalToastInfo</button>
    <button class="btn btn-primary btn-sm"
            onclick="exampleSwalToastQuestion()"
            type="button">exampleSwalToastQuestion</button>
  </div>

  <button onclick="exampleSwalConfirmSuccess()"
          type="button">exampleSwalConfirmSuccess</button>
  <button onclick="exampleSwalConfirmError()"
          type="button">exampleSwalConfirmError</button>

  <div aria-hidden="true"
       aria-labelledby="exampleModalLabel"
       class="modal fade"
       id="exampleModal"
       tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5"
              id="exampleModalLabel">Modal title</h1>
          <button aria-label="Close"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  type="button"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary"
                  data-bs-dismiss="modal"
                  type="button">Close</button>
          <button class="btn btn-primary"
                  type="button">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <br>
  <br>

  <h2>¡Bienvenido al Panel Administrativo!</h2>
  <p>Ahora tu menú lateral tiene submenús desplegables con animación suave y diseño profesional.
  </p>

  <div class="row g-2">
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3><i class="fa fa-users"></i> Usuarios Activos</h3>
          <span>1,234</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3><i class="fa fa-shopping-cart"></i> Ventas Hoy</h3>
          <span>$5,678</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3><i class="fa fa-chart-line"></i> Crecimiento</h3>
          <span>+12%</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3><i class="fa fa-box"></i> Productos</h3>
          <span>892</span>

        </div>
      </div>
    </div>
  </div>
  <script>
    function exampleSwalToastSuccess() {
      SwalToastSuccess.fire({});
    }

    function exampleSwalToastError() {
      SwalToastError.fire({});
    }

    function exampleSwalToastWarning() {
      SwalToastWarning.fire({});
    }

    function exampleSwalToastInfo() {
      SwalToastInfo.fire({});
    }

    function exampleSwalToastQuestion() {
      SwalToastQuestion.fire({});
    }



    function exampleSwalConfirmSuccess() {
      SwalConfirm.fire({
        icon: 'success',

      });
    }

    function exampleSwalConfirmError() {
      SwalConfirm.fire({
        icon: 'error',
      });
    }

    function exampleSwalConfirmWarning() {
      SwalConfirm.fire({
        icon: 'warning',
      });
    }

    function exampleSwalConfirmInfo() {
      SwalConfirm.fire({
        icon: 'info',
      });
    }

    function exampleSwalConfirmQuestion() {
      SwalConfirm.fire({
        icon: 'question',
      });
    }

    document.addEventListener('DOMContentLoaded', function() {

      window.SwalConfirm = SwalConfirm.mixin({
        confirmButtonText: `<i class='fas fa-check'></i> Confirmar`,
        cancelButtonText: `<i class='fas fa-times'></i> Cancelar`,
      })

      const toastTrigger = document.getElementById('liveToastBtn')
      const toastLiveExample = document.getElementById('liveToast')

      if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
          toastBootstrap.show()
        })
      }
    });
  </script> --}}
</div>

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
    
    
    <h2 class="py-3">¡Bienvenido al Panel Administrativo!</h2>
    <div class="col-md-6">
      <div class="neo-card">
        <div class="neo-title">
          <div class="neo-title-icon">
            <svg fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2" />
            </svg>
          </div>
          <div class="neo-title-text">Saldo de aporte pendiente</div>
          <div class="neo-percent">
            <svg fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2" />
            </svg>
            <?php echo e($result['porcentaje_aportes']); ?>%
          </div>
        </div>

        <div class="neo-data">
          <p class="neo-data-value"><?php echo e($result['aportes']); ?> Bs</p>
          <p class="neo-data-label my-0">Total adeudado</p>

          <div class="neo-progress-container">
            <div class="neo-progress-fill"
                 style="width: <?php echo e($result['porcentaje_aportes']); ?>%"></div>
          </div>

          <div class="neo-progress-label">
            <span>0%</span>
            <span>100%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="neo-card">
        <div class="neo-title">
          <div class="neo-title-icon">
            <svg fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2" />
            </svg>
          </div>
          <div class="neo-title-text">Saldo total pendiente</div>
          <div class="neo-percent">
            <svg fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2" />
            </svg>
            <?php echo e($result['porcentaje_restante']); ?>%
          </div>
        </div>

        <div class="neo-data">
          <p class="neo-data-value"><?php echo e($result['total_tramites']); ?> Bs</p>
          <p class="neo-data-label my-0">Total adeudado</p>

          <div class="neo-progress-container">
            <div class="neo-progress-fill"
                 style="width: <?php echo e($result['porcentaje_restante']); ?>%"></div>
          </div>

          <div class="neo-progress-label">
            <span>0%</span>
            <span>100%</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-dark h-100 border">
        <div class="card-body p-2">
          <h3 class="text-dark"  >Deuda por tipo de tarifa</h3>
          <div id="chartFees"
               style="flex: 1; height: 400px;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-dark h-100 border">
        <div class="card-body p-2">
          <h3 class="text-dark" >Proporción de afiliados según su estado</h3>
          <div id="chartStatus"
               style="flex: 1; height: 400px;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card border-dark h-100 border">
        <div class="card-body p-2">
          <h3 class="text-dark" >Aportes por mes del 2025</h3>
          <div id="chartFeesLine"></div>
        </div>
      </div>
    </div>
  </div>












  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // feesJson ya es JSON, podemos usarlo directamente
    var feesData = <?php echo $feesJson; ?>;

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
    var estatusData = <?php echo $estatusJson; ?>;

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




    var feesData = <?php echo \Illuminate\Support\Js::from($dataMonths)->toHtml() ?>;

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




















































  
</div>
<?php /**PATH D:\ICAPV4\ICAP\resources\views/livewire/dashboard/index.blade.php ENDPATH**/ ?>
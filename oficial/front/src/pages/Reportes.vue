<template>
  <q-page class="q-pa-md">
    <q-card flat bordered class="q-pa-md">
      <div class="text-h6 q-mb-md">Inscritos por Profesión</div>
      <apexchart type="bar" height="350" :options="chartOptions" :series="chartSeries"/>
      <!--      <apexchart width="500" type="bar" :options="options" :series="series"></apexchart>-->
      <q-table
        :rows-per-page-options="[0]"
        :rows="registros"
        :columns="columns"
        row-key="profession"
        class="q-mt-lg"
        flat
        bordered
        dense
      />
    </q-card>
  </q-page>
</template>

<script>
// import VueApexCharts from 'vue-apexcharts'
import VueApexCharts from 'vue3-apexcharts'

export default {
  name: 'ReportesPage',
  components: {
    apexchart: VueApexCharts
  },
  data () {
    return {
      registros: [],
      chartSeries: [],
      chartOptions: {
        chart: {
          id: 'reporte-tipo',
          toolbar: { show: true }
        },
        xaxis: {
          categories: []
        },
        dataLabels: {
          enabled: true,
          formatter: function (_, opts) {
            return opts.w.config.series[0].data[opts.dataPointIndex].customData
          }
        },
        legend: {
          show: false
        },
        plotOptions: {
          bar: {
            distributed: true
          }
        },
        colors: ['#43a047', '#1e88e5', '#fbc02d', '#e53935'] // colores por mesa
      },
      columns: [
        { name: 'profession', label: 'Profesión', field: 'profession', align: 'left' },
        { name: 'total', label: 'Cantidad', field: 'total', align: 'right' }
      ]
    }
  },
  mounted () {
    this.obtenerDatos()
  },
  methods: {
    async obtenerDatos () {
      try {
        const response = await this.$axios.get('/inscritos-por-profesion')
        // Actualiza solo el array de datos sin romper la reactividad
        // this.chartSeries[0].data = response.data.map(item => item.total)
        // this.chartOptions.xaxis.categories = response.data.map(item => item.profession)
        // Asegura que no se muestre la leyenda numérica
        // this.chartOptions.legend.show = false
        this.registros = response.data
        this.chartSeries = [{
          name: 'Cantidad',
          data: response.data.map(item => item.total)
        }]
        this.chartOptions.xaxis.categories = response.data.map(item => item.profession)
        // this.chartOptions.xaxis.categories = ['a']
        // this.chartOptions.xaxis = {
        //   categories: response.data.map(item => item.profession),
        //   labels: {
        //     rotate: -45,
        //     trim: false,
        //     style: {
        //       fontSize: '12px'
        //     }
        //   }
        // }
        // this.chartOptions = {
        //   ...this.chartOptions,
        //   xaxis: {
        //     categories: ['a'],
        //     labels: {
        //       rotate: -45,
        //       trim: false,
        //       style: {
        //         fontSize: '12px'
        //       }
        //     }
        //   }
        // }
        console.log(this.chartOptions.xaxis.categories)
      } catch (error) {
        console.error('Error al obtener datos:', error)
      }
    }
  }
}
</script>

<template>
  <div class="admin-dashboard">
    <!-- Filtro de fechas -->
    <div class="filter-bar">
      <div class="filter-title">Estadísticas en tiempo real</div>
      <div class="filter-controls">
        <input type="date" v-model="desde" @change="fetchStats" class="date-input" placeholder="Desde"/>
        <input type="date" v-model="hasta" @change="fetchStats" class="date-input" placeholder="Hasta"/>
        <button @click="clearFilter" class="btn-clear">Limpiar</button>
      </div>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="loading-state">
      <div class="spinner"></div>
      <span>Cargando estadísticas...</span>
    </div>

    <template v-else>
      <!-- Stat Cards -->
      <div class="stat-grid">
        <div class="stat-card">
          <div class="stat-icon" style="background:#fef2f2; color:#c0392b;">👥</div>
          <div class="stat-body">
            <div class="stat-num">{{ stats.total_registros }}</div>
            <div class="stat-label">Total inscritos</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#eff6ff; color:#1d4ed8;">🎓</div>
          <div class="stat-body">
            <div class="stat-num">{{ eventoCount('simposio') }}</div>
            <div class="stat-label">Simposio</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#f0fdf4; color:#166534;">🔬</div>
          <div class="stat-body">
            <div class="stat-num">{{ eventoCount('taller') }}</div>
            <div class="stat-label">Taller</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#fefce8; color:#92400e;">✅</div>
          <div class="stat-body">
            <div class="stat-num">{{ stats.confirmados }}</div>
            <div class="stat-label">Confirmados</div>
          </div>
        </div>
      </div>

      <!-- Charts row -->
      <div class="charts-grid">
        <!-- Donut: por profesión -->
        <div class="chart-card">
          <div class="chart-title">Por profesión</div>
          <apexchart
            v-if="profChartData.labels.length"
            type="donut"
            height="260"
            :options="donutOptions(profChartData.labels)"
            :series="profChartData.series"
          />
          <div v-else class="chart-empty">Sin datos</div>
        </div>

        <!-- Bar: por departamento -->
        <div class="chart-card">
          <div class="chart-title">Por departamento</div>
          <apexchart
            v-if="deptChartData.labels.length"
            type="bar"
            height="260"
            :options="barOptions(deptChartData.labels)"
            :series="[{ name: 'Inscritos', data: deptChartData.series }]"
          />
          <div v-else class="chart-empty">Sin datos</div>
        </div>

        <!-- Horizontal bar: por modalidad -->
        <div class="chart-card">
          <div class="chart-title">Por modalidad</div>
          <apexchart
            v-if="modalChartData.labels.length"
            type="bar"
            height="260"
            :options="hbarOptions(modalChartData.labels)"
            :series="[{ name: 'Inscritos', data: modalChartData.series }]"
          />
          <div v-else class="chart-empty">Sin datos</div>
        </div>
      </div>

      <!-- Tabla recientes -->
      <div class="recientes-card">
        <div class="chart-title">Últimos 5 registros</div>
        <table class="rec-table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Profesión</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="r in stats.recientes" :key="r.created_at">
              <td>{{ r.firstName }} {{ r.firstSurname }}</td>
              <td>{{ r.profession || '—' }}</td>
              <td>{{ formatDate(r.created_at) }}</td>
            </tr>
            <tr v-if="!stats.recientes || !stats.recientes.length">
              <td colspan="3" style="text-align:center; color:#9ca3af; padding:1.5rem;">Sin registros aún</td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </div>
</template>

<script>
import { defineComponent, ref, computed, onMounted } from 'vue'

export default defineComponent({
  name: 'AdminApp',
  setup() {
    const stats   = ref({ total_registros: 0, confirmados: 0, por_evento: [], por_profesion: [], por_departamento: [], por_modalidad: [], recientes: [] })
    const loading = ref(true)
    const desde   = ref('')
    const hasta   = ref('')

    const CRIMSON = '#c0392b'

    async function fetchStats() {
      loading.value = true
      try {
        const url = new URL(window.STATS_URL)
        if (desde.value) url.searchParams.set('desde', desde.value)
        if (hasta.value) url.searchParams.set('hasta', hasta.value)
        const res = await fetch(url.toString(), {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        stats.value = await res.json()
      } catch (e) {
        console.error('Error fetching stats', e)
      } finally {
        loading.value = false
      }
    }

    function clearFilter() {
      desde.value = ''
      hasta.value = ''
      fetchStats()
    }

    function eventoCount(ev) {
      if (!stats.value.por_evento) return 0
      const found = stats.value.por_evento.find(e => (e.label || '').toLowerCase().includes(ev))
      return found ? found.total : 0
    }

    const profChartData = computed(() => {
      const items = stats.value.por_profesion || []
      return { labels: items.map(i => i.label || 'N/A'), series: items.map(i => Number(i.total)) }
    })
    const deptChartData = computed(() => {
      const items = stats.value.por_departamento || []
      return { labels: items.map(i => i.label || 'N/A'), series: items.map(i => Number(i.total)) }
    })
    const modalChartData = computed(() => {
      const items = stats.value.por_modalidad || []
      return { labels: items.map(i => i.label || 'N/A'), series: items.map(i => Number(i.total)) }
    })

    function donutOptions(labels) {
      return {
        labels,
        colors: [CRIMSON, '#e74c3c', '#c0392b', '#a93226', '#7b1a1a', '#922b21'],
        legend: { position: 'bottom', fontSize: '11px' },
        dataLabels: { enabled: true },
        chart: { toolbar: { show: false } },
      }
    }
    function barOptions(categories) {
      return {
        chart: { type: 'bar', toolbar: { show: false } },
        xaxis: { categories, labels: { style: { fontSize: '11px' } } },
        colors: [CRIMSON],
        plotOptions: { bar: { borderRadius: 4 } },
        dataLabels: { enabled: false },
      }
    }
    function hbarOptions(categories) {
      return {
        chart: { type: 'bar', toolbar: { show: false } },
        plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
        xaxis: { categories, labels: { style: { fontSize: '11px' } } },
        colors: [CRIMSON],
        dataLabels: { enabled: false },
      }
    }

    function formatDate(str) {
      if (!str) return '—'
      return new Date(str).toLocaleDateString('es-BO', { day: '2-digit', month: '2-digit', year: 'numeric' })
    }

    onMounted(() => fetchStats())

    return { stats, loading, desde, hasta, fetchStats, clearFilter, eventoCount, profChartData, deptChartData, modalChartData, donutOptions, barOptions, hbarOptions, formatDate }
  }
})
</script>

<style scoped>
.admin-dashboard { font-family: 'Mulish', sans-serif; }
/* Filter bar */
.filter-bar { display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 0.875rem 1.25rem; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem; }
.filter-title { font-family: 'Sora', sans-serif; font-weight: 700; font-size: 0.9rem; color: #0d0003; }
.filter-controls { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
.date-input { padding: 0.45rem 0.75rem; border: 1.5px solid #d1d5db; border-radius: 0.5rem; font-size: 0.8rem; outline: none; font-family: 'Mulish', sans-serif; }
.date-input:focus { border-color: #c0392b; }
.btn-clear { padding: 0.45rem 0.875rem; background: #f3f4f6; border: none; border-radius: 0.5rem; font-size: 0.8rem; cursor: pointer; color: #555; }
.btn-clear:hover { background: #e5e7eb; }
/* Loading */
.loading-state { display: flex; align-items: center; justify-content: center; gap: 1rem; padding: 4rem; color: #9ca3af; }
.spinner { width: 24px; height: 24px; border: 3px solid #f3f4f6; border-top-color: #c0392b; border-radius: 50%; animation: spin 0.7s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
/* Stat cards */
.stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.25rem; }
@media (max-width: 900px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 500px) { .stat-grid { grid-template-columns: 1fr; } }
.stat-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }
.stat-icon { width: 48px; height: 48px; border-radius: 0.65rem; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
.stat-num { font-family: 'Sora', sans-serif; font-size: 1.75rem; font-weight: 800; color: #0d0003; line-height: 1; }
.stat-label { font-size: 0.78rem; color: #9ca3af; margin-top: 0.2rem; font-weight: 600; }
/* Charts */
.charts-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.25rem; }
@media (max-width: 1000px) { .charts-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .charts-grid { grid-template-columns: 1fr; } }
.chart-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; }
.chart-title { font-family: 'Sora', sans-serif; font-size: 0.875rem; font-weight: 700; color: #0d0003; margin-bottom: 0.75rem; }
.chart-empty { display: flex; align-items: center; justify-content: center; height: 200px; color: #d1d5db; font-size: 0.875rem; }
/* Recientes */
.recientes-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; }
.rec-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
.rec-table th { padding: 0.6rem 0.75rem; text-align: left; font-size: 0.72rem; text-transform: uppercase; font-weight: 700; color: #9ca3af; border-bottom: 1px solid #f3f4f6; }
.rec-table td { padding: 0.65rem 0.75rem; border-bottom: 1px solid #f9fafb; color: #374151; }
.rec-table tr:last-child td { border-bottom: none; }
</style>

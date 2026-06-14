<template>
  <div class="crono">
    <div v-if="loading" class="portal-loading">
      <div class="spinner"></div><span>Cargando cronograma…</span>
    </div>

    <template v-else>
      <!-- Tabs -->
      <div class="tabs">
        <button
          v-for="day in days"
          :key="day.key"
          class="tab-btn"
          :class="{ 'tab-btn--active': activeDay === day.key }"
          @click="activeDay = day.key"
        >
          <span class="tab-tag">{{ day.tag }}</span>
          <span class="tab-date">{{ day.label }}</span>
        </button>
      </div>

      <!-- Slots del día activo -->
      <div class="sched" v-if="activeSlots.length">
        <div
          v-for="slot in activeSlots"
          :key="slot.id"
          class="slot"
          :class="{ 'slot--break': slot.is_break }"
        >
          <div class="slot-time">
            {{ slot.time_start }}<small v-if="slot.time_end"> — {{ slot.time_end }}</small>
          </div>
          <div class="slot-body">
            <div class="slot-title">{{ slot.title }}</div>
            <div class="slot-desc" v-if="slot.description && !slot.is_break">{{ slot.description }}</div>
          </div>
        </div>
      </div>
      <div v-else class="empty-state">No hay actividades registradas para este día.</div>
    </template>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const slots   = ref({})
const loading = ref(true)
const activeDay = ref('d1')

const days = computed(() => {
  return Object.keys(slots.value).map(key => {
    const first = slots.value[key][0]
    return { key, label: first?.day_label ?? key, tag: first?.day_tag ?? '' }
  })
})

const activeSlots = computed(() => slots.value[activeDay.value] ?? [])

onMounted(async () => {
  try {
    const r = await fetch('/portal/api/cronograma', { headers: { Accept: 'application/json' } })
    if (r.ok) slots.value = await r.json()
    if (Object.keys(slots.value).length) activeDay.value = Object.keys(slots.value)[0]
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.crono { display: flex; flex-direction: column; gap: 1.25rem; }

/* Tabs */
.tabs { display: flex; gap: .5rem; flex-wrap: wrap; }
.tab-btn {
  display: flex; flex-direction: column; align-items: flex-start;
  padding: .6rem 1.1rem; border-radius: 12px; border: 1.5px solid var(--line);
  background: var(--white); cursor: pointer; transition: .2s; min-width: 110px;
}
.tab-btn:hover { border-color: var(--crimson); }
.tab-btn--active { background: var(--crimson); border-color: var(--crimson); }
.tab-tag  { font-size: .65rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--ink-soft); }
.tab-date { font-family: var(--font-d); font-size: .95rem; font-weight: 700; color: var(--ink); }
.tab-btn--active .tab-tag,
.tab-btn--active .tab-date { color: #fff; }

/* Schedule */
.sched {
  background: var(--white); border: 1px solid var(--line);
  border-radius: var(--radius); overflow: hidden;
}
.slot {
  display: grid; grid-template-columns: 130px 1fr; gap: 1.25rem;
  padding: 1rem 1.5rem; border-bottom: 1px solid var(--line); transition: background .15s;
}
.slot:last-child { border-bottom: 0; }
.slot:hover { background: #fdf5f5; }
.slot--break { background: #faf5f5; }
.slot--break .slot-title { color: var(--ink-soft); font-weight: 500; }
.slot-time {
  font-family: var(--font-d); font-weight: 700; font-size: .9rem;
  color: var(--crimson); white-space: nowrap; font-variant-numeric: tabular-nums; padding-top: .1rem;
}
.slot-time small { display: block; color: var(--ink-soft); font-size: .72rem; font-weight: 400; }
.slot-title { font-family: var(--font-d); font-size: .97rem; font-weight: 700; color: var(--ink); }
.slot-desc  { font-size: .85rem; color: var(--ink-soft); margin-top: .25rem; line-height: 1.55; }

.empty-state {
  background: var(--white); border: 1px solid var(--line); border-radius: var(--radius);
  padding: 3rem; text-align: center; color: var(--ink-soft); font-style: italic;
}

@media (max-width: 600px) {
  .slot { grid-template-columns: 90px 1fr; padding: .85rem 1rem; gap: .75rem; }
}
</style>

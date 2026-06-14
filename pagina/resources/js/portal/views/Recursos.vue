<template>
  <div class="recursos">
    <div v-if="loading" class="portal-loading">
      <div class="spinner"></div><span>Cargando recursos…</span>
    </div>

    <template v-else-if="recursos.length">
      <div class="rec-grid">
        <a
          v-for="r in recursos"
          :key="r.id"
          :href="r.url || (r.file_path ? '/storage/' + r.file_path : '#')"
          target="_blank"
          rel="noopener"
          class="rec-card"
        >
          <div class="rec-icon-wrap" :class="'rec-icon--' + r.type">
            <span class="rec-icon">{{ typeIcon(r.type) }}</span>
          </div>
          <div class="rec-body">
            <div class="rec-type-label">{{ typeLabel(r.type) }}</div>
            <div class="rec-title">{{ r.title }}</div>
            <div class="rec-desc" v-if="r.description">{{ r.description }}</div>
          </div>
          <span class="rec-arrow">→</span>
        </a>
      </div>
    </template>

    <div v-else class="empty-box">
      <div class="empty-icon">📭</div>
      <h3>Recursos próximamente</h3>
      <p>El material del simposio estará disponible aquí antes del evento.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const recursos = ref([])
const loading  = ref(true)

function typeIcon(t)  { return t === 'video' ? '🎬' : t === 'file' ? '📄' : '🔗' }
function typeLabel(t) { return t === 'video' ? 'Video' : t === 'file' ? 'Archivo' : 'Enlace' }

onMounted(async () => {
  try {
    const r = await fetch('/portal/api/recursos', { headers: { Accept: 'application/json' } })
    if (r.ok) recursos.value = await r.json()
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
.recursos { display: flex; flex-direction: column; gap: 1rem; }
.rec-grid { display: flex; flex-direction: column; gap: .75rem; }
.rec-card {
  display: flex; align-items: center; gap: 1rem; background: var(--white);
  border: 1.5px solid var(--line); border-radius: var(--radius); padding: 1.1rem 1.25rem;
  text-decoration: none; color: var(--ink); transition: .2s;
}
.rec-card:hover { border-color: var(--crimson); box-shadow: 0 3px 12px rgba(192,57,43,.1); }
.rec-icon-wrap {
  width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center;
  flex-shrink: 0; font-size: 1.4rem;
}
.rec-icon--link  { background: #eff6ff; }
.rec-icon--file  { background: #fef9c3; }
.rec-icon--video { background: #fce7f3; }
.rec-body { flex: 1; }
.rec-type-label { font-size: .66rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: var(--crimson); margin-bottom: .2rem; }
.rec-title { font-family: var(--font-d); font-weight: 700; font-size: .95rem; color: var(--ink); }
.rec-desc  { font-size: .82rem; color: var(--ink-soft); margin-top: .2rem; }
.rec-arrow { font-size: 1.1rem; color: var(--ink-soft); flex-shrink: 0; transition: .2s; }
.rec-card:hover .rec-arrow { color: var(--crimson); transform: translateX(3px); }

.empty-box {
  background: var(--white); border: 1px solid var(--line); border-radius: var(--radius);
  padding: 4rem 2rem; text-align: center; color: var(--ink-soft);
}
.empty-icon { font-size: 3rem; margin-bottom: 1rem; }
.empty-box h3 { font-family: var(--font-d); font-size: 1.1rem; font-weight: 700; color: var(--ink); margin-bottom: .5rem; }
.empty-box p  { font-size: .9rem; max-width: 320px; margin: 0 auto; }
</style>

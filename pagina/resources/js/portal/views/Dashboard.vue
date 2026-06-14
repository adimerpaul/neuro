<template>
  <div class="dash">
    <!-- Bienvenida -->
    <div class="welcome-card">
      <div class="welcome-left">
        <div class="p-eyebrow">Portal del participante</div>
        <h2 class="welcome-title">¡Bienvenido, {{ firstName }}!</h2>
        <p class="welcome-sub">Aquí puedes revisar el cronograma, recursos y gestionar tu perfil.</p>
        <div class="welcome-badge" :class="confirmado ? 'badge--ok' : 'badge--warn'">
          <span>{{ confirmado ? '✅ Inscripción confirmada' : '⏳ Pago pendiente de confirmación' }}</span>
        </div>
      </div>
      <div class="welcome-avatar">{{ initials }}</div>
    </div>

    <!-- Resumen -->
    <div class="info-grid" v-if="registro">
      <div class="info-item">
        <div class="info-label">Nombre completo</div>
        <div class="info-val">{{ registro.firstName }} {{ registro.secondName }} {{ registro.firstSurname }} {{ registro.secondSurname }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">Profesión</div>
        <div class="info-val">{{ registro.profession }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">Evento</div>
        <div class="info-val">{{ registro.cursoTaller || 'Simposio Internacional' }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">Modalidad</div>
        <div class="info-val">{{ registro.modalidad || 'Presencial' }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">Departamento</div>
        <div class="info-val">{{ registro.departamento }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">CI</div>
        <div class="info-val">{{ registro.ci }}</div>
      </div>
    </div>

    <!-- Acceso rápido -->
    <h3 class="section-title">Acceso rápido</h3>
    <div class="quick-grid">
      <router-link to="/cronograma" class="quick-card">
        <span class="quick-icon">📅</span>
        <div>
          <div class="quick-title">Cronograma</div>
          <div class="quick-sub">23, 24 y 25 Julio 2026</div>
        </div>
      </router-link>
      <router-link to="/recursos" class="quick-card">
        <span class="quick-icon">📚</span>
        <div>
          <div class="quick-title">Recursos</div>
          <div class="quick-sub">Material del simposio</div>
        </div>
      </router-link>
      <router-link to="/mis-datos" class="quick-card">
        <span class="quick-icon">👤</span>
        <div>
          <div class="quick-title">Mis Datos</div>
          <div class="quick-sub">Actualizar información</div>
        </div>
      </router-link>
      <router-link to="/cambiar-password" class="quick-card">
        <span class="quick-icon">🔑</span>
        <div>
          <div class="quick-title">Cambiar Contraseña</div>
          <div class="quick-sub">Seguridad de cuenta</div>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({ user: Object })

const registro   = computed(() => props.user?.registro ?? null)
const firstName  = computed(() => props.user?.name?.split(' ')[0] ?? '')
const confirmado = computed(() => registro.value?.confirmado ?? false)
const initials   = computed(() => {
  const parts = (props.user?.name ?? '').trim().split(' ')
  return parts.length >= 2
    ? (parts[0][0] + parts[parts.length - 1][0]).toUpperCase()
    : (parts[0]?.[0] ?? '?').toUpperCase()
})
</script>

<style scoped>
.dash { display: flex; flex-direction: column; gap: 1.75rem; }

/* Welcome */
.welcome-card {
  background: linear-gradient(135deg, #1a0006, #3d000e);
  border-radius: 18px; padding: 2rem 2rem;
  display: flex; align-items: center; justify-content: space-between; gap: 1.5rem;
  color: #fff; position: relative; overflow: hidden;
}
.welcome-card::after {
  content: ''; position: absolute; right: -40px; top: -60px;
  width: 220px; height: 220px; border-radius: 50%;
  background: rgba(192,57,43,.25); pointer-events: none;
}
.welcome-left { position: relative; z-index: 1; }
.welcome-title { font-family: var(--font-d); font-size: clamp(1.4rem,3vw,1.9rem); font-weight: 800; margin-bottom: .5rem; }
.welcome-sub   { color: rgba(255,255,255,.72); font-size: .95rem; margin-bottom: 1rem; }
.welcome-badge {
  display: inline-flex; align-items: center; gap: .4rem;
  padding: .4em .9em; border-radius: 999px; font-size: .82rem; font-family: var(--font-d); font-weight: 600;
}
.badge--ok   { background: rgba(134,239,172,.18); color: #86efac; border: 1px solid rgba(134,239,172,.3); }
.badge--warn { background: rgba(253,224,71,.18);  color: #fde047; border: 1px solid rgba(253,224,71,.3); }
.welcome-avatar {
  width: 80px; height: 80px; border-radius: 50%;
  background: var(--crimson); color: #fff; font-family: var(--font-d);
  font-weight: 800; font-size: 1.8rem; display: grid; place-items: center;
  flex-shrink: 0; box-shadow: 0 4px 16px rgba(0,0,0,.3); position: relative; z-index: 1;
}

/* Info grid */
.info-grid {
  display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px;
  background: var(--line); border-radius: var(--radius); overflow: hidden;
  border: 1px solid var(--line);
}
.info-item { background: var(--white); padding: 1rem 1.25rem; }
.info-label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--ink-soft); margin-bottom: .3rem; }
.info-val   { font-family: var(--font-d); font-size: .95rem; font-weight: 600; color: var(--ink); }

/* Section title */
.section-title { font-family: var(--font-d); font-size: .95rem; font-weight: 700; color: var(--ink); }

/* Quick links */
.quick-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
.quick-card {
  display: flex; align-items: center; gap: .85rem;
  background: var(--white); border: 1.5px solid var(--line); border-radius: var(--radius);
  padding: 1.1rem 1.25rem; text-decoration: none; color: var(--ink);
  transition: .2s; box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.quick-card:hover { border-color: var(--crimson); box-shadow: 0 4px 16px rgba(192,57,43,.12); transform: translateY(-2px); }
.quick-icon { font-size: 1.6rem; flex-shrink: 0; }
.quick-title { font-family: var(--font-d); font-weight: 700; font-size: .9rem; }
.quick-sub   { font-size: .76rem; color: var(--ink-soft); margin-top: .15rem; }

@media (max-width: 900px) {
  .info-grid { grid-template-columns: 1fr 1fr; }
  .quick-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 560px) {
  .welcome-avatar { display: none; }
  .info-grid { grid-template-columns: 1fr; }
  .quick-grid { grid-template-columns: 1fr; }
}
</style>

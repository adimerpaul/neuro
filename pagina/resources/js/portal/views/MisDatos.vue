<template>
  <div class="mis-datos">

    <!-- Info readonly -->
    <div class="p-card">
      <div class="p-card-title">📋 Datos de inscripción</div>
      <div class="info-grid">
        <div class="info-row"><span class="info-lbl">Nombre completo</span><span class="info-val">{{ nombreCompleto }}</span></div>
        <div class="info-row"><span class="info-lbl">Carnet de Identidad</span><span class="info-val">{{ reg.ci }}</span></div>
        <div class="info-row"><span class="info-lbl">Profesión</span><span class="info-val">{{ reg.profession }}</span></div>
        <div class="info-row"><span class="info-lbl">Departamento</span><span class="info-val">{{ reg.departamento }}</span></div>
        <div class="info-row"><span class="info-lbl">Evento</span><span class="info-val">{{ reg.cursoTaller || 'Simposio Internacional' }}</span></div>
        <div class="info-row"><span class="info-lbl">Modalidad</span><span class="info-val">{{ reg.modalidad || 'Presencial' }}</span></div>
        <div class="info-row">
          <span class="info-lbl">Estado</span>
          <span class="info-badge" :class="reg.confirmado ? 'badge-ok' : 'badge-warn'">
            {{ reg.confirmado ? '✅ Confirmado' : '⏳ Pendiente de pago' }}
          </span>
        </div>
        <div class="info-row"><span class="info-lbl">Usuario</span><span class="info-val">@{{ user.nickname }}</span></div>
      </div>
    </div>

    <!-- Formulario editable -->
    <div class="p-card">
      <div class="p-card-title">✏️ Actualizar datos de contacto</div>

      <div v-if="alert.msg" class="pf-alert" :class="alert.ok ? 'pf-alert--ok' : 'pf-alert--err'">
        {{ alert.msg }}
      </div>

      <form @submit.prevent="submit">
        <div class="pf-row">
          <div class="pf-group">
            <label class="pf-label">Celular / WhatsApp</label>
            <input class="pf-input" v-model="form.phone" type="tel" placeholder="70000000">
          </div>
          <div class="pf-group">
            <label class="pf-label">Correo electrónico</label>
            <input class="pf-input" v-model="form.email" type="email" placeholder="tu@correo.com">
          </div>
        </div>
        <div class="pf-row">
          <div class="pf-group">
            <label class="pf-label">Provincia / Municipio</label>
            <input class="pf-input" v-model="form.provincia" type="text" placeholder="Ej. Cercado">
          </div>
          <div class="pf-group">
            <label class="pf-label">Dirección</label>
            <input class="pf-input" v-model="form.direccion" type="text" placeholder="Calle, N°, Barrio">
          </div>
        </div>
        <button type="submit" class="pf-btn" :disabled="saving">
          <span v-if="saving">Guardando…</span>
          <span v-else>Guardar cambios</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({ user: Object })

const reg    = ref({})
const saving = ref(false)
const alert  = ref({ msg: '', ok: true })
const csrf   = document.querySelector('meta[name="csrf-token"]')?.content ?? ''

const form = ref({ phone: '', email: '', provincia: '', direccion: '' })

const nombreCompleto = computed(() => {
  return [reg.value.firstName, reg.value.secondName, reg.value.firstSurname, reg.value.secondSurname]
    .filter(Boolean).join(' ')
})

onMounted(async () => {
  const r = await fetch('/portal/api/me', { headers: { Accept: 'application/json' } })
  if (r.ok) {
    const data = await r.json()
    reg.value  = data.registro ?? {}
    form.value = {
      phone: reg.value.phone ?? '',
      email: reg.value.email ?? '',
      provincia: reg.value.provincia ?? '',
      direccion: reg.value.direccion ?? '',
    }
  }
})

async function submit() {
  saving.value = true
  alert.value  = { msg: '', ok: true }
  try {
    const r = await fetch('/portal/api/mis-datos', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrf,
      },
      body: JSON.stringify(form.value),
    })
    const data = await r.json()
    if (r.ok) {
      alert.value = { msg: '✅ Datos actualizados correctamente.', ok: true }
      Object.assign(reg.value, form.value)
    } else {
      const msgs = data.errors ? Object.values(data.errors).flat().join(' · ') : (data.message || 'Error al guardar.')
      alert.value = { msg: msgs, ok: false }
    }
  } catch {
    alert.value = { msg: 'Error de conexión.', ok: false }
  } finally {
    saving.value = false
  }
}
</script>

<style scoped>
.mis-datos { display: flex; flex-direction: column; gap: 1.25rem; }
.info-grid { display: flex; flex-direction: column; gap: 0; border: 1px solid var(--line); border-radius: 10px; overflow: hidden; }
.info-row {
  display: flex; align-items: center; gap: 1rem; padding: .75rem 1rem;
  border-bottom: 1px solid var(--line); font-size: .9rem;
}
.info-row:last-child { border-bottom: 0; }
.info-lbl { width: 180px; flex-shrink: 0; font-size: .78rem; font-weight: 700; color: var(--ink-soft); text-transform: uppercase; letter-spacing: .04em; }
.info-val { font-family: var(--font-d); font-weight: 600; color: var(--ink); }
.info-badge { padding: .25em .75em; border-radius: 999px; font-family: var(--font-d); font-size: .8rem; font-weight: 600; }
.badge-ok   { background: #dcfce7; color: #166534; }
.badge-warn { background: #fef9c3; color: #92400e; }

@media (max-width: 600px) {
  .info-row { flex-direction: column; align-items: flex-start; gap: .25rem; }
  .info-lbl { width: auto; }
}
</style>

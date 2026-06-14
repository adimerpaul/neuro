<template>
  <div class="cp-wrap">
    <div class="p-card">
      <div class="p-card-title">🔑 Cambiar contraseña</div>

      <div v-if="alert.msg" class="pf-alert" :class="alert.ok ? 'pf-alert--ok' : 'pf-alert--err'">
        {{ alert.msg }}
      </div>

      <form @submit.prevent="submit">
        <div class="pf-group">
          <label class="pf-label">Contraseña actual</label>
          <div class="pw-wrap">
            <input
              class="pf-input"
              v-model="form.current_password"
              :type="show.current ? 'text' : 'password'"
              placeholder="Tu contraseña actual"
              required
            >
            <button type="button" class="pw-eye" @click="show.current = !show.current">
              {{ show.current ? '🙈' : '👁️' }}
            </button>
          </div>
        </div>

        <div class="pf-row">
          <div class="pf-group">
            <label class="pf-label">Nueva contraseña</label>
            <div class="pw-wrap">
              <input
                class="pf-input"
                v-model="form.password"
                :type="show.password ? 'text' : 'password'"
                placeholder="Mínimo 8 caracteres"
                required
              >
              <button type="button" class="pw-eye" @click="show.password = !show.password">
                {{ show.password ? '🙈' : '👁️' }}
              </button>
            </div>
            <div class="pw-strength" v-if="form.password">
              <div class="pw-bar" :style="{ width: strength.pct + '%', background: strength.color }"></div>
              <span class="pw-label">{{ strength.label }}</span>
            </div>
          </div>
          <div class="pf-group">
            <label class="pf-label">Confirmar nueva contraseña</label>
            <div class="pw-wrap">
              <input
                class="pf-input"
                v-model="form.password_confirmation"
                :type="show.confirm ? 'text' : 'password'"
                placeholder="Repetir contraseña"
                :class="{ 'pf-input--err': form.password_confirmation && form.password !== form.password_confirmation }"
                required
              >
              <button type="button" class="pw-eye" @click="show.confirm = !show.confirm">
                {{ show.confirm ? '🙈' : '👁️' }}
              </button>
            </div>
            <div class="pw-match-err" v-if="form.password_confirmation && form.password !== form.password_confirmation">
              Las contraseñas no coinciden
            </div>
          </div>
        </div>

        <button type="submit" class="pf-btn" :disabled="saving || !canSubmit">
          <span v-if="saving">Guardando…</span>
          <span v-else>Actualizar contraseña</span>
        </button>
      </form>
    </div>

    <div class="p-card tips-card">
      <div class="p-card-title">💡 Consejos de seguridad</div>
      <ul class="tips-list">
        <li>Usa al menos 8 caracteres con números y letras.</li>
        <li>Evita datos personales como tu nombre o CI.</li>
        <li>No compartas tu contraseña con nadie.</li>
        <li>Si olvidaste tu contraseña, contacta a un administrador.</li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({ user: Object })

const saving = ref(false)
const alert  = ref({ msg: '', ok: true })
const csrf   = document.querySelector('meta[name="csrf-token"]')?.content ?? ''

const form = ref({ current_password: '', password: '', password_confirmation: '' })
const show = ref({ current: false, password: false, confirm: false })

const strength = computed(() => {
  const p = form.value.password
  if (!p) return { pct: 0, color: '#ccc', label: '' }
  let score = 0
  if (p.length >= 8)  score++
  if (p.length >= 12) score++
  if (/[A-Z]/.test(p)) score++
  if (/[0-9]/.test(p)) score++
  if (/[^A-Za-z0-9]/.test(p)) score++
  if (score <= 1) return { pct: 20,  color: '#ef4444', label: 'Muy débil' }
  if (score === 2) return { pct: 40,  color: '#f97316', label: 'Débil' }
  if (score === 3) return { pct: 65,  color: '#eab308', label: 'Regular' }
  if (score === 4) return { pct: 85,  color: '#22c55e', label: 'Fuerte' }
  return                 { pct: 100, color: '#16a34a', label: 'Muy fuerte' }
})

const canSubmit = computed(() =>
  form.value.current_password.length > 0 &&
  form.value.password.length >= 8 &&
  form.value.password === form.value.password_confirmation
)

async function submit() {
  saving.value = true
  alert.value  = { msg: '', ok: true }
  try {
    const r = await fetch('/portal/api/cambiar-password', {
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
      alert.value = { msg: '✅ Contraseña actualizada correctamente.', ok: true }
      form.value  = { current_password: '', password: '', password_confirmation: '' }
    } else {
      const msgs = data.errors
        ? Object.values(data.errors).flat().join(' · ')
        : (data.message || 'Error al actualizar.')
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
.cp-wrap { display: flex; flex-direction: column; gap: 1.25rem; }

.pw-wrap { position: relative; }
.pw-wrap .pf-input { padding-right: 2.8rem; }
.pw-eye {
  position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);
  background: none; border: none; cursor: pointer; font-size: 1rem; line-height: 1; padding: 0;
}

.pw-strength { display: flex; align-items: center; gap: .6rem; margin-top: .4rem; }
.pw-bar {
  height: 4px; border-radius: 2px; transition: width .3s, background .3s;
  flex: 0 0 auto;
}
.pw-label { font-size: .72rem; font-weight: 600; color: var(--ink-soft); }
.pf-input--err { border-color: #ef4444 !important; }
.pw-match-err  { font-size: .72rem; color: #b91c1c; margin-top: .25rem; }

.tips-card { background: #fdf5f5; border-color: #f5c6cb; }
.tips-list  { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
.tips-list li { font-size: .87rem; color: var(--ink-soft); padding-left: 1.2rem; position: relative; }
.tips-list li::before { content: '•'; position: absolute; left: 0; color: var(--crimson); font-weight: 700; }
</style>

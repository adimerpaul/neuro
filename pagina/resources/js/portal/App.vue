<template>
  <div class="portal-wrap">

    <!-- SIDEBAR -->
    <aside class="sidebar" :class="{ 'sidebar-open': mobileOpen }">
      <div class="sb-logo">
        <div class="sb-logo-icon">🧠</div>
        <div>
          <div class="sb-logo-name">NeuroOruro</div>
          <div class="sb-logo-sub">2026</div>
        </div>
      </div>

      <nav class="sb-nav">
        <span class="sb-label">Menú</span>
        <router-link to="/"                 class="sb-item" active-class="sb-item--active" exact @click="mobileOpen=false">
          <span class="sb-icon">📊</span> Dashboard
        </router-link>
        <router-link to="/cronograma"       class="sb-item" active-class="sb-item--active" @click="mobileOpen=false">
          <span class="sb-icon">📅</span> Cronograma
        </router-link>
        <router-link to="/recursos"         class="sb-item" active-class="sb-item--active" @click="mobileOpen=false">
          <span class="sb-icon">📚</span> Recursos
        </router-link>

        <span class="sb-label" style="margin-top:1rem">Mi cuenta</span>
        <router-link to="/mis-datos"        class="sb-item" active-class="sb-item--active" @click="mobileOpen=false">
          <span class="sb-icon">👤</span> Mis Datos
        </router-link>
        <router-link to="/cambiar-password" class="sb-item" active-class="sb-item--active" @click="mobileOpen=false">
          <span class="sb-icon">🔑</span> Cambiar Contraseña
        </router-link>

        <template v-if="user.is_admin">
          <span class="sb-label" style="margin-top:1rem">Administración</span>
          <a href="/admin/participantes" class="sb-item">
            <span class="sb-icon">👥</span> Participantes
          </a>
          <a href="/admin/cronograma" class="sb-item">
            <span class="sb-icon">📅</span> Gestionar cronograma
          </a>
          <a href="/admin/precios" class="sb-item">
            <span class="sb-icon">💰</span> Precios
          </a>
          <a href="/admin/recursos" class="sb-item">
            <span class="sb-icon">📚</span> Gestionar recursos
          </a>
          <a href="/admin/usuarios" class="sb-item">
            <span class="sb-icon">🔐</span> Usuarios
          </a>
        </template>
      </nav>

      <div class="sb-foot">
        <div class="sb-user">
          <div class="sb-avatar">{{ initials }}</div>
          <div class="sb-user-info">
            <div class="sb-user-name">{{ user.name }}</div>
            <div class="sb-user-nick">@{{ user.nickname }}</div>
          </div>
        </div>
        <form method="POST" action="/logout" class="sb-logout">
          <input type="hidden" name="_token" :value="csrf">
          <button type="submit" class="sb-logout-btn">
            <span>↩</span> Salir
          </button>
        </form>
      </div>
    </aside>

    <!-- OVERLAY mobile -->
    <div class="sidebar-overlay" v-if="mobileOpen" @click="mobileOpen=false"></div>

    <!-- MAIN -->
    <div class="portal-main">
      <header class="portal-header">
        <button class="hamburger" @click="mobileOpen=!mobileOpen">☰</button>
        <h1 class="portal-page-title">{{ $route.meta.title }}</h1>
        <div class="portal-header-user">
          <div class="hdr-avatar">{{ initials }}</div>
          <span class="hdr-name">{{ user.name }}</span>
        </div>
      </header>

      <main class="portal-content">
        <div v-if="loading" class="portal-loading">
          <div class="spinner"></div>
          <span>Cargando…</span>
        </div>
        <router-view v-else :user="user" @refresh="fetchUser" />
      </main>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const user       = ref({ name: '', nickname: '', is_admin: false })
const loading    = ref(true)
const mobileOpen = ref(false)
const csrf       = ref(document.querySelector('meta[name="csrf-token"]')?.content ?? '')

const initials = computed(() => {
  const parts = user.value.name.trim().split(' ')
  return parts.length >= 2
    ? (parts[0][0] + parts[parts.length - 1][0]).toUpperCase()
    : (parts[0]?.[0] ?? '?').toUpperCase()
})

async function fetchUser() {
  try {
    const r = await fetch('/portal/api/me', { headers: { Accept: 'application/json' } })
    if (r.ok) user.value = await r.json()
  } finally {
    loading.value = false
  }
}

onMounted(fetchUser)
</script>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --crimson: #c0392b;
  --crimson-dk: #9b0000;
  --navy: #1a0006;
  --navy-dk: #0d0003;
  --bg: #f5f8fc;
  --white: #fff;
  --line: #e8e0e2;
  --ink: #1e0a0d;
  --ink-soft: #6b3042;
  --sb-w: 240px;
  --font-d: 'Sora', system-ui, sans-serif;
  --font-b: 'Mulish', system-ui, sans-serif;
  --radius: 14px;
}
body { font-family: var(--font-b); background: var(--bg); }

/* Layout */
.portal-wrap { display: flex; min-height: 100vh; }

/* Sidebar */
.sidebar {
  width: var(--sb-w); background: var(--navy); display: flex; flex-direction: column;
  position: fixed; inset: 0 auto 0 0; z-index: 200; transition: transform .25s;
}
.sb-logo {
  display: flex; align-items: center; gap: .75rem; padding: 1.25rem 1rem;
  border-bottom: 1px solid rgba(255,255,255,.08);
}
.sb-logo-icon { font-size: 1.8rem; line-height: 1; }
.sb-logo-name { font-family: var(--font-d); font-size: 1.05rem; font-weight: 800; color: #fff; }
.sb-logo-sub  { font-size: .68rem; color: rgba(255,255,255,.45); }

.sb-nav { flex: 1; overflow-y: auto; padding: .75rem 0; }
.sb-label {
  display: block; padding: .4rem 1rem .2rem;
  font-size: .62rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
  color: rgba(255,255,255,.3);
}
.sb-item {
  display: flex; align-items: center; gap: .65rem; padding: .6rem 1rem;
  color: rgba(255,255,255,.68); font-size: .875rem; font-weight: 500;
  text-decoration: none; border-left: 3px solid transparent; transition: .15s;
}
.sb-item:hover { background: rgba(255,255,255,.07); color: #fff; }
.sb-item--active { background: rgba(192,57,43,.22); color: #fff; border-left-color: var(--crimson); }
.sb-icon { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }

.sb-foot {
  border-top: 1px solid rgba(255,255,255,.08);
  padding: .75rem 1rem;
  display: flex; flex-direction: column; gap: .5rem;
}
.sb-user { display: flex; align-items: center; gap: .6rem; }
.sb-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: var(--crimson); color: #fff; font-family: var(--font-d);
  font-weight: 700; font-size: .8rem; display: grid; place-items: center; flex-shrink: 0;
}
.sb-user-name { font-size: .82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sb-user-nick { font-size: .7rem; color: rgba(255,255,255,.45); }
.sb-logout { margin-top: .1rem; }
.sb-logout-btn {
  width: 100%; background: none; border: 1px solid rgba(255,255,255,.15);
  color: rgba(255,255,255,.6); border-radius: 8px; padding: .45em .75em;
  font-family: var(--font-b); font-size: .82rem; cursor: pointer; display: flex;
  align-items: center; gap: .5rem; transition: .15s;
}
.sb-logout-btn:hover { background: rgba(255,255,255,.08); color: #fff; }

/* Main area */
.portal-main { margin-left: var(--sb-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

/* Header */
.portal-header {
  background: var(--white); border-bottom: 1px solid var(--line);
  padding: .85rem 1.5rem; display: flex; align-items: center; gap: 1rem;
  position: sticky; top: 0; z-index: 100; box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.hamburger { display: none; background: none; border: none; font-size: 1.4rem; cursor: pointer; padding: .2rem; }
.portal-page-title { font-family: var(--font-d); font-size: 1.15rem; font-weight: 700; color: var(--ink); flex: 1; }
.portal-header-user { display: flex; align-items: center; gap: .5rem; }
.hdr-avatar {
  width: 34px; height: 34px; border-radius: 50%;
  background: var(--crimson); color: #fff; font-family: var(--font-d);
  font-weight: 700; font-size: .78rem; display: grid; place-items: center;
}
.hdr-name { font-size: .85rem; font-weight: 600; color: var(--ink); }

/* Content */
.portal-content { flex: 1; padding: 2rem 2rem 3rem; }

/* Loading */
.portal-loading { display: flex; flex-direction: column; align-items: center; gap: .75rem; padding: 4rem; color: var(--ink-soft); }
.spinner {
  width: 36px; height: 36px; border: 3px solid var(--line);
  border-top-color: var(--crimson); border-radius: 50%; animation: spin .7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* Overlay mobile */
.sidebar-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 199; }

/* Shared card */
.p-card {
  background: var(--white); border-radius: var(--radius);
  border: 1px solid var(--line); padding: 1.5rem;
  box-shadow: 0 1px 3px rgba(0,0,0,.05);
}
.p-card-title {
  font-family: var(--font-d); font-size: 1rem; font-weight: 700;
  color: var(--ink); margin-bottom: 1rem; padding-bottom: .75rem;
  border-bottom: 1px solid var(--line);
}
.p-eyebrow {
  font-family: var(--font-d); font-size: .68rem; font-weight: 700;
  letter-spacing: .12em; text-transform: uppercase; color: var(--crimson);
  margin-bottom: .35rem;
}

/* Shared form */
.pf-group { display: flex; flex-direction: column; gap: .35rem; margin-bottom: 1rem; }
.pf-label { font-size: .78rem; font-weight: 700; color: var(--ink); font-family: var(--font-d); }
.pf-input {
  font-family: var(--font-b); font-size: .93rem; padding: .65em .9em;
  border: 1.5px solid var(--line); border-radius: 10px; background: var(--bg);
  color: var(--ink); outline: none; transition: .2s; width: 100%;
}
.pf-input:focus { border-color: var(--crimson); background: #fff; box-shadow: 0 0 0 3px rgba(192,57,43,.1); }
.pf-input[readonly] { background: var(--bg); color: var(--ink-soft); cursor: default; }
.pf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.pf-btn {
  background: var(--crimson); color: #fff; border: none; border-radius: 10px;
  padding: .75em 1.5em; font-family: var(--font-d); font-weight: 600; font-size: .94rem;
  cursor: pointer; transition: .18s; display: inline-flex; align-items: center; gap: .5rem;
}
.pf-btn:hover { background: var(--crimson-dk); }
.pf-btn:disabled { opacity: .6; cursor: default; }
.pf-alert {
  padding: .65em 1em; border-radius: 8px; font-size: .85rem; font-family: var(--font-d);
  font-weight: 600; margin-bottom: 1rem;
}
.pf-alert--ok  { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
.pf-alert--err { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }

@media (max-width: 768px) {
  .sidebar { transform: translateX(-100%); }
  .sidebar.sidebar-open { transform: translateX(0); }
  .portal-main { margin-left: 0; }
  .hamburger { display: block; }
  .hdr-name { display: none; }
  .portal-content { padding: 1.25rem 1rem 2rem; }
  .pf-row { grid-template-columns: 1fr; }
}
</style>

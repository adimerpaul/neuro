import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import App from './portal/App.vue'
import Dashboard from './portal/views/Dashboard.vue'
import Cronograma from './portal/views/Cronograma.vue'
import Recursos from './portal/views/Recursos.vue'
import MisDatos from './portal/views/MisDatos.vue'
import CambiarPassword from './portal/views/CambiarPassword.vue'

const router = createRouter({
    history: createWebHistory('/portal'),
    routes: [
        { path: '/',                 component: Dashboard,       meta: { title: 'Mi Panel' } },
        { path: '/cronograma',       component: Cronograma,      meta: { title: 'Cronograma' } },
        { path: '/recursos',         component: Recursos,        meta: { title: 'Recursos' } },
        { path: '/mis-datos',        component: MisDatos,        meta: { title: 'Mis Datos' } },
        { path: '/cambiar-password', component: CambiarPassword, meta: { title: 'Cambiar Contraseña' } },
    ],
})

router.afterEach((to) => {
    document.title = (to.meta.title || 'Portal') + ' — NeuroOruro 2026'
})

const app = createApp(App)
app.use(router)
app.mount('#portal-app')

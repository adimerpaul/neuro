<template>
  <q-layout view="lHh Lpr lff">
    <q-header class="">
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />
        <q-space />
        <q-btn icon="o_menu" color="white" v-if="$q.screen.lt.md" flat @click="modalMenu= true"/>
        <q-toolbar class="" v-else>
          <q-space />
          <q-tabs shrink class="text-white">
            <q-route-tab name="Inicio" label="Inicio" to="/" no-caps/>
            <q-route-tab name="Programa general" label="Programa general" to="/programa" no-caps/>
            <q-route-tab name="Contactos" label="Contactos" to="/contacto" no-caps/>
            <q-route-tab name="Mapa" label="Lugar Evento" to="/mapa" no-caps/>
<!--            <q-tab name="ingresar" no-caps>-->
<!--              <q-btn label="Ingresar" to="/login" color="white" text-color="black" no-caps size="14px" />-->
<!--            </q-tab>-->
          </q-tabs>
        </q-toolbar>

        <div>
          <q-btn icon="account_circle" flat round color="white">
            <q-menu>
              <q-list>
                <q-item clickable v-ripple to="/perfil">
                  <q-item-section avatar>
                    <q-avatar>
                      <q-icon name="o_account_circle" />
                    </q-avatar>
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>Mis datos </q-item-label>
                    <q-item-section side>
                      <q-item-label caption>{{$store.user.name}}</q-item-label>
                    </q-item-section>
                  </q-item-section>
                </q-item>
                <q-item clickable v-ripple to="/changePassword">
                  <q-item-section avatar>
                    <q-avatar>
                      <q-icon name="o_lock" />
                    </q-avatar>
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>Cambiar contraseña</q-item-label>
                  </q-item-section>
                </q-item>
                <q-item clickable v-ripple @click="logout">
                  <q-item-section avatar>
                    <q-avatar>
                      <q-icon name="logout" />
                    </q-avatar>
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>Salir</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="250"
      :breakpoint="400"
    >
      <q-layout class="bg-grey-3">
        <q-header class="bg-grey-3">
          <q-list class="text-black" separator bordered dense>
            <q-item-label header class="q-pa-none">
              <q-item dense>
                <q-item-section>
                  <q-item-label>
                    <q-linear-progress stripe rounded size="20px" :value="$store.porcentaje/100" color="primary" class="q-mt-sm">
                      <div class="absolute-full flex flex-center">
                        <q-badge color="white" size="10px" text-color="accent" :label="`${$store.porcentaje}%`"/>
                      </div>
                    </q-linear-progress>
                    <div class="text-center">
                      Porcentaje de avance
                      <q-icon name="help" class="q-ml-sm">
                        <q-tooltip>
                          <div class="text-center">
                            <div class="text-h6">Porcentaje de avance</div>
                            <div class="text-subtitle2">Muestra el porcentaje de avance de los videos vistos una vez finalizado el evento.</div>
                          </div>
                        </q-tooltip>
                      </q-icon>
                    </div>
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-item-label>
            <q-item clickable to="/perfil" exact active-class="bg-primary text-white text-bold">
              <q-item-section avatar>
                <q-icon name="o_home" />
              </q-item-section>
              <q-item-section >
<!--                <q-item-label>Inicio</q-item-label>-->
                <q-item-label caption :class="path=='/perfil'?'text-white':'text-black'"><b>Bienvenido:</b>{{$store.user.name}}</q-item-label>
                <q-item-label caption :class="path=='/perfil'?'text-white':'text-black'"><b>Profesion:</b>{{$store.user.profession}}</q-item-label>
              </q-item-section>
            </q-item>
            <q-separator></q-separator>
            <q-item-label header >
              5ta Jornada Nacional de Neurología
            </q-item-label>
            <q-separator></q-separator>
            <q-expansion-item
              dense
              expand-separator
              icon="event_available"
              label="Dias de Jornadas"
              class="text-bold"
              default-opened
            >
              <q-item dense clickable to="/dia13/2025-06-12" exact class="text-weight-regular" active-class="bg-primary text-white">
                <q-item-section avatar>
                  <q-icon name="event_available" />
                </q-item-section>
                <q-item-section>
                  Jueves 12-Jun-2025
                </q-item-section>
              </q-item>
              <q-item dense clickable to="/dia13/2025-06-13" exact class="text-weight-regular" active-class="bg-primary text-white">
                <q-item-section avatar>
                  <q-icon name="event_available" />
                </q-item-section>
                <q-item-section>
                  Viernes 13-Jun-2025
                </q-item-section>
              </q-item>
              <q-item dense clickable to="/dia13/2025-06-14" exact class="text-weight-regular" active-class="bg-primary text-white">
                <q-item-section avatar>
                  <q-icon name="event_available" />
                </q-item-section>
                <q-item-section>
                  Sábado 14-Jun-2025
                </q-item-section>
              </q-item>
            </q-expansion-item>
            <q-expansion-item
              dense
              expand-separator
              icon="schedule"
              label="Dias de Taller"
              class="text-bold"
            >
              <q-item dense clickable to="/dia13/t" exact class="text-weight-regular" active-class="bg-primary text-white">
                <q-item-section avatar>
                  <q-icon name="event_available" />
                </q-item-section>
                <q-item-section>
                  Viernes 13-Jun-2025
                </q-item-section>
              </q-item>
            </q-expansion-item>
<!--            <q-item-label header >-->
<!--              2da Simposio Internacional de Neurología-->
<!--            </q-item-label>-->
<!--            <q-item clickable to="/dia13/2025-06-12" exact active-class="bg-primary text-white text-bold">-->
<!--              <q-item-section avatar>-->
<!--                <q-icon name="event_available" />-->
<!--              </q-item-section>-->
<!--              <q-item-section>-->
<!--                Sábado 16-Sep-2023-->
<!--              </q-item-section>-->
<!--            </q-item>-->
<!--            <q-item clickable to="/dia13/2023-09-17" exact active-class="bg-primary text-white text-bold">-->
<!--              <q-item-section avatar>-->
<!--                <q-icon name="event_available" />-->
<!--              </q-item-section>-->
<!--              <q-item-section>-->
<!--                Domingo 17-Sep-2023-->
<!--              </q-item-section>-->
<!--            </q-item>-->
            <q-item clickable to="/biblioteca" exact active-class="bg-primary text-white text-bold">
              <q-item-section avatar>
                <q-icon name="o_library_books" />
              </q-item-section>
              <q-item-section>
                Biblioteca virtual
              </q-item-section>
            </q-item>
            <q-item clickable to="/perfil" exact active-class="bg-primary text-white text-bold">
            <q-item-section avatar >
                <q-icon name="o_account_circle" />
              </q-item-section>
              <q-item-section>
                <q-item-label>
                  <q-item-label>Mis datos</q-item-label>
                </q-item-label>
              </q-item-section>
            </q-item>
            <q-item clickable to="/" exact active-class="bg-primary text-white text-bold">
              <q-item-section avatar>
                <q-icon name="o_public" />
              </q-item-section>
              <q-item-section>
                Pagina Web
              </q-item-section>
            </q-item>
            <q-item clickable to="/users" exact active-class="bg-primary text-white text-bold" v-if="$store.user.id==1 || $store.user.id==7">
              <q-item-section avatar>
                <q-icon name="o_people" />
              </q-item-section>
              <q-item-section>
                Administrar Usuarios
              </q-item-section>
            </q-item>
            <q-item clickable to="/register" exact active-class="bg-primary text-white text-bold" v-if="$store.user.id==1 || $store.user.id==7">
              <q-item-section avatar>
                <q-icon name="o_person_add" />
              </q-item-section>
              <q-item-section>
                Personas Inscritas
              </q-item-section>
            </q-item>
            <q-item clickable to="/reportes" exact active-class="bg-primary text-white text-bold" v-if="$store.user.id==1 || $store.user.id==7">
              <q-item-section avatar>
                <q-icon name="o_person_add" />
              </q-item-section>
              <q-item-section>
                Reportes
              </q-item-section>
            </q-item>
<!--            <q-item clickable to="/estadisticos" exact active-class="bg-primary text-white text-bold" v-if="$store.user.id==1">-->
<!--              <q-item-section avatar>-->
<!--                <q-icon name="o_bar_chart" />-->
<!--              </q-item-section>-->
<!--              <q-item-section>-->
<!--                Datos Estadisticos-->
<!--              </q-item-section>-->
<!--            </q-item>-->
          </q-list>
        </q-header>
        <q-footer class="bg-grey-3">
          <q-list bordered padding dense class="rounded-borders text-red">
            <q-item clickable v-ripple @click="logout()">
              <q-item-section avatar>
                <q-icon name="o_logout" />
              </q-item-section>
              <q-item-section> Cerrar sesión</q-item-section>
            </q-item>
          </q-list>
        </q-footer>
      </q-layout>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
    <FooterComponent></FooterComponent>
    <q-dialog v-model="modalMenu" position="top">
      <q-card class="q-pa-md bg-primary">
        <q-card-section class="q-pa-md">
          <div class="text-subtitle1 text-center">
            <q-item-label header class="text-h6">Menu</q-item-label>
          </div>
          <q-btn label="Inicio" color="primary" to="/" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
          <q-btn label="Programa general" color="primary" to="/programa" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
          <q-btn label="Expositores" color="primary" to="/expositores" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
          <q-btn label="Contactos" color="primary" to="/contacto" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
          <q-btn label="Lugar Evento" color="primary" to="/mapa" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
          <q-btn icon="login" label="Ingresar" to="/login" color="primary" size="14px" class="full-width text-bold text-white" flat @click="modalMenu= false"/>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-layout>

</template>

<script>
import FooterComponent from 'components/FooterComponent.vue'

export default {
  name: 'MainLayout',
  components: {
    FooterComponent
  },
  data () {
    return {
      value: 0.05,
      modalMenu: false,
      leftDrawerOpen: false
    }
  },
  methods: {
    logout () {
      this.$q.dialog({
        message: '¿Quieres cerrar sesión?',
        title: 'Salir',
        ok: {
          push: true
        },
        cancel: {
          push: true,
          color: 'negative'
        }
      }).onOk(() => {
        this.$q.loading.show()
        this.$axios.post('logout').then(() => {
          this.$axios.defaults.headers.common.Authorization = ''
          this.$store.user = {}
          localStorage.removeItem('tokenNeuro')
          this.$store.isLoggedIn = false
          this.$q.loading.hide()
          this.$router.push('/login')
        })
      })
    }
  },
  computed: {
    path () {
      return this.$route.path
    }
  }
}
</script>

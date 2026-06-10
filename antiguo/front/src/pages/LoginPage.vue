<template>
  <q-layout>
    <q-page-container>
      <q-page class="fondo">
        <div class="row">
          <div class="col-12 col-md-4"></div>
          <div class="col-12 col-md-4 q-pa-lg">
            <q-card class="q-mt-md">
              <q-card-section class="text-center">
                <div class="text-h5 text-bold">{{userOption === 'login' ? 'Iniciar sesión' : 'Registrarse'}}</div>
<!--                {{userOption === 'login' ? 'Si ya tienes una cuenta, inicia sesión' : 'Si no tienes una cuenta, registrate'}}-->
                <q-img src="images/quirquin3.png" width="150px" />
                <div class="text-h6 text-bold">5ta Jornada Nacional de Neurología</div>
                <div class="text-subtitle2 text-bold">
                  <q-icon name="o_location_on" />  “Avances en diagnóstico y tratamiento de enfermedades neurológicas”
                </div>
              </q-card-section>
              <q-card-section>
                <q-form @submit="login" v-if="userOption === 'login'">
                  <q-input
                    v-model="email"
                    label="Carnet de identidad"
                    filled
                    lazy-rules
                    :rules="[val => val.length > 0 || 'El carnet de identidad es requerido']"
                  />
<!--                  <q-input-->
<!--                    v-model="email"-->
<!--                    label="email"-->
<!--                    filled-->
<!--                    lazy-rules-->
<!--                    :rules="[val => val.length > 0 || 'El usuario es requerido']"-->
<!--                  />-->
                  <q-input
                    :type="passwordVisible ? 'text' : 'password'"
                    v-model="password"
                    label="Contraseña"
                    filled
                    lazy-rules
                    :rules="[val => val.length > 0 || 'La contraseña es requerida']"
                  >
                    <template v-slot:append>
                      <q-icon class="cursor-pointer" @click="passwordVisible = !passwordVisible" :name="passwordVisible ? 'visibility_off' : 'visibility'">
                        <q-tooltip>Contraseña</q-tooltip>
                      </q-icon>
                    </template>
                  </q-input>
                  <div class="q-py-xs">
                    <a href="https://wa.me/59172461667" target="_blank"
                       class="text-primary">¿Olvidaste tu contraseña?</a>
                  </div>
                  <q-btn label="Iniciar sesión" color="primary" no-caps rounded icon="o_login" :loading="loading" class="full-width" type="submit"/>
<!--                  <q-btn label="Registrarse" color="primary" no-caps rounded outline icon="o_person_add" class="full-width q-mt-xs" @click="userOption = 'register'"/>-->
                  <q-btn label="Pagina principal" color="primary" no-caps rounded flat icon="public" class="full-width q-mt-xs" @click="$router.push('/')"/>
                </q-form>
<!--                $table->string('firstName')->nullable();-->
<!--                $table->string('secondName')->nullable();-->
<!--                $table->string('lastName')->nullable();-->
<!--                $table->string('secondLastName')->nullable();-->
<!--                $table->string('phone')->nullable();-->
<!--                $table->string('profession')->nullable();-->
<!--                $table->string('email')->unique();-->
<!--                $table->string('departamento')->nullable();-->
<!--                $table->string('provincia')->nullable();-->
<!--                $table->string('direccion')->nullable();-->
<!--                $table->string('ci')->nullable();-->
<!--                $table->string('celular')->nullable();-->
                <q-form v-else @submit.prevent="register">
                  <q-input v-model="user.firstName" label="Primer nombre" filled lazy-rules :rules="[val => val.length > 0 || 'El primer nombre es requerido']" :name="user.firstName"/>
                  <q-input v-model="user.secondName" label="Segundo nombre" filled lazy-rules  :name="user.secondName" hint=""></q-input>
                  <q-input v-model="user.lastName" label="Primer apellido" filled lazy-rules :name="user.lastName" hint=""></q-input>
                  <q-input v-model="user.secondLastName" label="Segundo apellido" filled lazy-rules  :name="user.secondLastName" hint=""></q-input>
                  <q-input v-model="user.phone" label="Telefono" filled lazy-rules :rules="[val => val.length > 0 || 'El telefono es requerido']" :name="user.phone"/>
                  <q-select v-model="user.profession" label="Profesion" filled lazy-rules :rules="[val => val.length > 0 || 'La profesion es requerida']" :name="user.profession" :options="['Medico Gneral', 'specialista', 'Lic. en enfermeria', 'Aux. en nnfermeria', 'Estudiante', 'Otros']"/>
                  <q-input v-model="user.email" label="Email" filled lazy-rules :rules="[val => val.length > 0 || 'El email es requerido']" :name="user.email"/>
                  <q-select v-model="user.departamento" label="Departamento" filled lazy-rules :rules="[val => val.length > 0 || 'El departamento es requerido']" :name="user.departamento" :options="['Oruro', 'La Paz', 'Cochabamba', 'Santa Cruz', 'Potosi', 'Chuquisaca', 'Tarija', 'Beni', 'Pando', 'Otros']"/>
                  <q-input v-model="user.provincia" label="Provincia" filled lazy-rules :rules="[val => val.length > 0 || 'La provincia es requerida']" :name="user.provincia"/>
                  <q-input v-model="user.direccion" label="Direccion" filled lazy-rules :rules="[val => val.length > 0 || 'La direccion es requerida']" :name="user.direccion"/>
                  <q-input v-model="user.ci" label="CI" filled lazy-rules :rules="[val => val.length > 0 || 'El CI es requerido']" :name="user.ci"/>
                  <q-input :type="passwordVisible ? 'text' : 'password'" v-model="user.password" label="Contraseña" filled lazy-rules
                           :rules="[val => val.length > 0 || 'La contraseña es requerida']"
                  >
                    <template v-slot:append>
                      <q-icon class="cursor-pointer" @click="passwordVisible = !passwordVisible" :name="passwordVisible ? 'visibility_off' : 'visibility'">
                        <q-tooltip>Contraseña</q-tooltip>
                      </q-icon>
                    </template>
                  </q-input>
                  <q-input
                    :type="passwordVisible ? 'text' : 'password'"
                    v-model="user.password_confirmation"
                    label="Confirmar contraseña"
                    filled
                    lazy-rules
                    :rules="[val => val.length > 0 || 'La contraseña es requerida',
                      val => val === user.password || 'Las contraseñas no coinciden']"
                  >
                    <template v-slot:append>
                      <q-icon class="cursor-pointer" @click="passwordVisible = !passwordVisible" :name="passwordVisible ? 'visibility_off' : 'visibility'">
                        <q-tooltip>Contraseña</q-tooltip>
                      </q-icon>
                    </template>
                  </q-input>
                  <q-btn label="Registrarse" color="primary" no-caps rounded icon="o_person_add" :loading="loading" class="full-width" type="submit"/>
                  <q-btn label="Iniciar sesión" color="primary" no-caps rounded outline icon="o_login" class="full-width q-mt-xs" @click="userOption = 'login'"/>
                  <q-btn label="Pagina principal" color="primary" no-caps rounded flat icon="public" class="full-width q-mt-xs" @click="$router.push('/')"/>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
          <div class="col-12 col-md-4"></div>
        </div>
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>

export default {
  name: 'LoginPage',
  data () {
    return {
      email: '',
      password: '',
      loading: false,
      passwordVisible: false,
      userOption: 'login',
      user: {}
    }
  },
  mounted () {
    if (this.$store.isLoggedIn) {
      this.$router.push('/menu')
    }
  },
  methods: {
    login () {
      this.loading = true
      this.$axios.post('login', {
        email: this.email,
        password: this.password
      })
        .then(response => {
          this.$alert.success(`Bienvenido ${response.data.user.name}!`)
          this.$store.user = response.data.user
          this.$store.isLoggedIn = true
          this.$axios.defaults.headers.common.Authorization = `Bearer ${response.data.token}`
          localStorage.setItem('tokenNeuro', response.data.token)
          this.$router.push('/menu')
        })
        .catch(error => {
          this.$alert.error(error.response.data.message)
        })
        .finally(() => {
          this.loading = false
        })
    },
    register () {
      // this.loading = true
      // this.$axios.post('register', this.user)
      //   .then(response => {
      //     this.$alert.success(`Bienvenido ${response.data.user.name}!`)
      //     this.$store.user = response.data.user
      //     this.$store.isLoggedIn = true
      //     this.$axios.defaults.headers.common.Authorization = `Bearer ${response.data.token}`
      //     localStorage.setItem('tokenNeuro', response.data.token)
      //     this.$router.push('/menu')
      //   })
      //   .catch(error => {
      //     this.$alert.error(error.response.data.message)
      //   })
      //   .finally(() => {
      //     this.loading = false
      //   })
    }
  }
}
</script>

<style scoped>
.fondo{
  background-image: url("/images/plantilla diseño.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
</style>

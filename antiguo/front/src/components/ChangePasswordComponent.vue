<template>
  <div>
    <q-card-section class="q-pb-none">
      <div class="text-h6">Cambiar Contraseña</div>
    </q-card-section>
    <q-card-section>
      <q-form @submit.prevent="cambiarPass">
        <div class="row">
          <div class="col-6 col-md-2 text-bold">Contraseña Actual</div>
          <div class="col-6 col-md-4">
            <q-input outlined dense v-model="user.password" placeholder="Contraseña actual"
                     :rules="[val => !!val || 'Este campo es requerido']" :type="showPassword ? 'text' : 'password'">
              <template v-slot:append>
                <q-icon class="cursor-pointer" @click="showPassword = !showPassword" :name="showPassword ? 'visibility_off' : 'visibility'">
                  <q-tooltip>Contraseña</q-tooltip>
                </q-icon>
              </template>
            </q-input>
          </div>
          <div class="col-12 col-md-6"></div>
          <div class="col-6 col-md-2 text-bold">Nueva Contraseña</div>
          <div class="col-6 col-md-4">
            <q-input outlined dense v-model="user.newPassword" placeholder="Nueva contraseña"
                     :rules="[val => !!val || 'Este campo es requerido']" :type="showPassword ? 'text' : 'password'">
              <template v-slot:append>
                <q-icon class="cursor-pointer" @click="showPassword = !showPassword" :name="showPassword ? 'visibility_off' : 'visibility'">
                  <q-tooltip>Contraseña</q-tooltip>
                </q-icon>
              </template>
            </q-input>
          </div>
          <div class="col-12 col-md-6"></div>
          <div class="col-6 col-md-2 text-bold">Confirmar Contraseña</div>
          <div class="col-6 col-md-4">
            <q-input outlined dense v-model="user.confirmPassword" placeholder="Confirmar contraseña"
                     :rules="[val => !!val || 'Este campo es requerido', val => val === user.newPassword || 'Las contraseñas no coinciden']" :type="showPassword ? 'text' : 'password'">
              <template v-slot:append>
                <q-icon class="cursor-pointer" @click="showPassword = !showPassword" :name="showPassword ? 'visibility_off' : 'visibility'">
                  <q-tooltip>Contraseña</q-tooltip>
                </q-icon>
              </template>
            </q-input>
          </div>
          <div class="col-12 col-md-6"></div>
          <div class="col-12 col-md-12 flex flex-center q-pa-md">
            <q-btn color="primary" label="Cambiar Contraseña" :loading="loading" type="submit"/>
          </div>
        </div>
      </q-form>
    </q-card-section>
  </div>
</template>
<script>
export default {
  name: 'ChangePasswordComponent',
  data () {
    return {
      loading: false,
      user: this.$store.user,
      showPassword: false
    }
  },
  created () {
  },
  methods: {
    cambiarPass () {
      this.loading = true
      this.$axios.post('cambiarPass', this.user)
        .then(() => {
          this.loading = false
          this.user.password = ''
          this.user.newPassword = ''
          this.user.confirmPassword = ''
          this.$alert.success('Contraseña cambiada correctamente')
        })
        .catch((err) => {
          this.loading = false
          this.$alert.error(err.response.data.message)
        })
    }
  }
}
</script>

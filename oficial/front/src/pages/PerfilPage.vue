<template>
  <q-page class="q-pa-md bg-grey-3">
    <q-card>
      <q-card-section class="q-pb-none">
        <div class="text-h6">Perfil</div>
      </q-card-section>
      <q-card-section>
        <div class="row">
          <div class="col-6 col-md-2 text-bold">Primer Nombre</div>
          <div class="col-6 col-md-4">{{ $store.user.firstName }}</div>
          <div class="col-6 col-md-2 text-bold">Segundo Nombre</div>
          <div class="col-6 col-md-4">{{ $store.user.secondName }}</div>
          <div class="col-6 col-md-2 text-bold">Primer Apellido</div>
          <div class="col-6 col-md-4">{{ $store.user.lastName }}</div>
          <div class="col-6 col-md-2 text-bold">Segundo Apellido</div>
          <div class="col-6 col-md-4">{{ $store.user.secondLastName }}</div>
          <div class="col-6 col-md-2 text-bold">Telefono</div>
          <div class="col-6 col-md-4">{{ $store.user.phone }}</div>
          <div class="col-6 col-md-2 text-bold">Profesion</div>
          <div class="col-6 col-md-4">{{ $store.user.profession }}</div>
          <div class="col-6 col-md-2 text-bold">Email</div>
          <div class="col-6 col-md-4">{{ $store.user.email }}</div>
          <div class="col-6 col-md-2 text-bold">Departamento</div>
          <div class="col-6 col-md-4">{{ $store.user.departamento }}</div>
          <div class="col-6 col-md-2 text-bold">Provincia</div>
          <div class="col-6 col-md-4">{{ $store.user.provincia }}</div>
          <div class="col-6 col-md-2 text-bold">Direccion</div>
          <div class="col-6 col-md-4">{{ $store.user.direccion }}</div>
        </div>
      </q-card-section>
<!--      <ChangePasswordComponent/>-->
    </q-card>
<!--    <pre>{{$store.user}}</pre>-->
  </q-page>
</template>
<script>
// import ChangePasswordComponent from 'components/ChangePasswordComponent.vue'
export default {
  name: 'PerfilPage',
  // components: { ChangePasswordComponent },
  data () {
    return {
      loading: false,
      user: this.$store.user,
      showPassword: false
    }
  }
}
</script>
<style scoped lang="sass">

</style>

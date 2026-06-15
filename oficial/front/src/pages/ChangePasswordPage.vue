<template>
  <q-page class="q-pa-md bg-grey-3">
    <q-card>
      <ChangePassword/>
    </q-card>
<!--    <pre>{{$store.user}}</pre>-->
  </q-page>
</template>
<script>
import ChangePassword from 'components/ChangePasswordComponent.vue'
export default {
  name: 'ChangePasswordPage',
  components: {
    ChangePassword
  }
}
</script>
<style scoped lang="sass">

</style>

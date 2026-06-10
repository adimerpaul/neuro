<template>
      <q-page class="fondo q-pa-lg">
        <div class="row">
          <div class="col-12">
            <q-card class="q-pa-md bg-grey-3">
              <q-card-section class="text-h4 fondo">
                <div class="text-center text-bold text-white">
                  LUGAR DEL EVENTO
                </div>
              </q-card-section>
              <q-card-section class="q-pa-none">
                <div class="row">
                  <div class="col-12 col-md-6 flex flex-center">
                    <q-img src="images/sanagustin.jpeg" width="550px"/>
                  </div>
                  <div class="col-12 col-md-6 q-pt-md">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.250957594079!2d-67.10186089999999!3d-17.9775429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93e2b0c9a2df099f%3A0x942af6b7abaf733d!2sCLINICA%20SAN%20AGUSTIN!5e1!3m2!1ses-419!2sbo!4v1749333056574!5m2!1ses-419!2sbo" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>
      </q-page>
</template>

<script>

export default {
  name: 'ContactoPage',
  data () {
    return {
      programas: []
    }
  },
  mounted () {
    this.$axios.get('programa')
      .then(response => {
        this.programas = response.data
      })
      .catch(error => {
        this.$alert.error(error.response.data.message)
      })
  },
  methods: {
  }
}
</script>

<style scoped>
.fondo{
  background-image: url("/images/plomoOscuro.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
</style>

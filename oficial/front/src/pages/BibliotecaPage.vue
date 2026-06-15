<template>
      <q-page class="fondo3 q-pa-lg">
        <div class="row">
          <div class="col-12">
            <q-card class="q-pa-md bg-grey-3">
              <q-card-section class="text-h3 fondo3">
                <div class="text-center text-bold text-white">
                  BIBLIOTECA VIRTUAL
                </div>
              </q-card-section>
              <q-card-section class="q-pa-none">
                <div class="row">
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../a.pdf`">
                      700 Essential Neurology Checklists by Ibrahim Imam (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../b.pdf`">
                      Bioquimica Medica Baynes 5a Edicion.pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../c.pdf`">
                      Consejos a un joven estudiante de medicina.pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../d.pdf`">
                      Diagnostic imaging Spine by Ross, Moore (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../e.pdf`">
                      Localization in Clinical Neurology, 6th Edition by Paul W. Brazis, Joseph Masdeu, José Biller MD FACP FAAN FAHA (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../f.pdf`">
                      Los 7 pecados cerebrales_booksmedicos.org.pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../g.pdf`">
                      Neurologia de Merritt, 12a edición (Spanish Edition) by Timothy A. Pedley Lewis P. Rowland [Pedley, Timothy A.] (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../h.pdf`">
                      Neurologic-Psychiatric Syndromes in Focus Part I by Julien Bogousslavsky (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../i.pdf`">
                      Neurological Disorders in Famous Artists (Frontiers of Neurology and Neuroscience), Part 3 by J. Bogousslavsky, M. G. Hennerici, H. Bazner, C. Bassetti (z-lib.org).pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../j.pdf`">
                      Sindromes Neurologicos.pdf
                    </q-btn>
                  </div>
                  <div class="col-12 q-pa-xs">
                    <q-btn color="blue-10" icon="book" :href="`${$url}../../k.pdf`">
                      Tintinalli Manual de Medicina de Urgencias 7a Ed_booksmedicos.org.pdf
                    </q-btn>
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
  name: 'BibliotecaPage',
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
.fondo3{
  background-image: url("/images/plomoOscuro.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
</style>

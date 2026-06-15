<template>
      <q-page class="fondoA q-pa-lg">
        <div class="row">
          <div class="col-12">
            <q-card class="q-pa-md bg-grey-3">
              <q-card-section class="text-h4 fondoA">
                <div class="text-center text-bold text-white">
                  PROGRAMA GENERAL — NEURO ORURO 2026
                </div>
              </q-card-section>
              <q-card-section class="q-pa-none">
                <div class="row flex flex-center">
<!--                  <q-card v-for="p in programas" :key="p.date" class="q-my-md">-->
<!--                    <q-card-section >-->
<!--                      <div class="text-h6 text-blue-10 text-bold text-center" style="text-decoration: underline;">-->
<!--                        {{ $filters.dateDdM(p.date) }}-->
<!--                      </div>-->
<!--                      <div class="text-h6 texto-programa" v-for="video in p.videos" :key="video.id">-->
<!--                        <span class="text-red">{{video.hora}}</span> | {{video.text}}-{{video.title}}-->
<!--                      </div>-->
<!--                    </q-card-section>-->
<!--                  </q-card>-->
                  <q-card class="q-my-md">
                    <q-card-section class="q-pa-md">
                      <!-- Jueves 23 de Julio — Día 1 Simposio -->
                      <div class="text-h6 text-center text-bold text-primary">
                        Jueves 23 de Julio 2026 · Día 1 — Inauguración del Simposio
                      </div>
                      <div class="text-subtitle2 text-bold text-primary">1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura</div>
                      <ul class="texto-programa q-mt-sm">
                        <li><strong>08:00 – 09:00</strong> - Acreditación y entrega de credenciales</li>
                        <li><strong>09:00 – 09:30</strong> - Acto inaugural<br>Sociedad Boliviana de Neurología, Colegio Médico de Oruro y autoridades</li>
                        <li><strong>09:30 – 12:30</strong> - Módulo: Enfermedad cerebrovascular en la altura<br>Epidemiología, fisiopatología del ictus en altitud y casos clínicos</li>
                        <li><strong>12:30 – 14:00</strong> - Receso · almuerzo</li>
                        <li><strong>14:00 – 17:30</strong> - Módulo: Actualización en Código Ictus<br>Activación del código, trombólisis, trombectomía y coordinación hospitalaria</li>
                      </ul>

                      <!-- Viernes 24 de Julio — Día 2 Simposio + Taller -->
                      <div class="text-h6 text-center text-bold text-primary q-mt-md">
                        Viernes 24 de Julio 2026 · Día 2 — Simposio + Seminario-Taller
                      </div>
                      <div class="text-subtitle2 text-bold text-primary">Simposio Internacional + 1er Seminario-Taller Código Ictus</div>
                      <ul class="texto-programa q-mt-sm">
                        <li><strong>08:30 – 12:30</strong> - Módulo: Prevención primaria del ictus<br>Factores de riesgo, tamizaje, intervención temprana y educación comunitaria <em>(Simposio)</em></li>
                        <li><strong>09:00 – 17:00</strong> - 1er Seminario-Taller: Código Ictus y Manejo Hospitalario<br>Auditorio Hospital Gral. San Juan de Dios — protocolo código ictus, manejo de vía aérea, escalas neurológicas y simulación <em>(Taller)</em></li>
                        <li><strong>12:30 – 14:00</strong> - Receso · almuerzo</li>
                        <li><strong>14:00 – 17:30</strong> - Módulo: Atención de urgencias neurológicas<br>Status epiléptico, trauma y cuidado neurocrítico <em>(Simposio)</em></li>
                      </ul>

                      <!-- Sábado 25 de Julio — Día 3 Simposio -->
                      <div class="text-h6 text-center text-bold text-primary q-mt-md">
                        Sábado 25 de Julio 2026 · Día 3 — Cierre del Simposio
                      </div>
                      <div class="text-subtitle2 text-bold text-primary">1er Simposio Internacional de Enfermedad Cerebrovascular en la Altura</div>
                      <ul class="texto-programa q-mt-sm">
                        <li><strong>09:00 – 12:00</strong> - Módulo: Socialización del Ictus<br>Feria de ictus — Gobernación de Oruro y Plaza principal "10 de Febrero"</li>
                        <li><strong>09:00 – 11:30</strong> - Ponentes internacionales invitados<br>Conferencias magistrales en modalidad virtual y presencial</li>
                        <li><strong>12:00 – 14:00</strong> - Receso · almuerzo</li>
                        <li><strong>14:00 – 16:30</strong> - Mesa redonda y conclusiones<br>Debate interdisciplinario y perspectivas en neurología de la altura</li>
                        <li><strong>16:30 – 17:30</strong> - Entrega de certificados y clausura oficial del Simposio</li>
                      </ul>
                    </q-card-section>
                    <div class="q-pa-md">
                      <q-card-section class="text-h6 fondoA">
                        <div class="text-center text-bold text-white">
                          1er Seminario-Taller Código Ictus y Manejo Hospitalario
                        </div>
                      </q-card-section>
                      <div class="text-subtitle2 text-bold text-black">Lugar: Auditorio Hospital Gral. San Juan de Dios de Oruro</div>
                      <div class="text-subtitle2 text-bold text-black">Horario: 09:00 a 17:00 · Modalidad Híbrida</div>
                      <ul class="texto-programa q-mt-sm">
                        <li>Reconocimiento y activación del código ictus</li>
                        <li>Manejo de vía aérea en el paciente neurológico</li>
                        <li>Escalas neurológicas y valoración clínica</li>
                        <li>Simulación de casos clínicos</li>
                        <li>Coordinación hospitalaria en emergencias cerebrovasculares</li>
                      </ul>
                    </div>

                  </q-card>
                </div>
                <div class="text-h6">
<!--                  <pre>{{programas}}</pre>-->
                </div>
              </q-card-section>
            </q-card>
          </div>
        </div>
      </q-page>
</template>

<script>

export default {
  name: 'ProgramaPage',
  data () {
    return {
      programas: []
    }
  },
  mounted () {
    // this.$q.loading.show()
    // this.$axios.get('programa')
    //   .then(response => {
    //     this.programas = response.data
    //   })
    //   .catch(error => {
    //     this.$alert.error(error.response.data.message)
    //   }).finally(() => {
    //     this.$q.loading.hide()
    //   })
  },
  methods: {
  }
}
</script>

<style scoped>
.fondoA{
  background-image: url("/images/plomoOscuro.jpeg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
.texto-programa{
  text-indent: 2em;
}
@media (max-width: 1024px) {
  .texto-programa{
    text-indent: 0em;
    font-size: 12px;
  }
}
</style>

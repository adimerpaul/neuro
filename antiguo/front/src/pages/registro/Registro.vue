<template>
  <q-layout view="lHh Lpr fff">
    <q-page-container>
      <q-page class="text-center" style="background: #FBF0DB">
        <div>
        </div>
        <div class="row q-pa-md">
          <div class="col-12 col-md-2"></div>
          <div class="col-12 col-md-8">
            <q-img src="header.jpg" width="100%" height="100px" class="q-mb-md" />
          </div>
          <div class="col-12 col-md-2"></div>
          <div class="col-12">
            <div class="text-h4 text-center q-mb-md text-bold">
              5ta. Jornada Nacional de Neurología
            </div>
          </div>
          <div class="col-12 col-md-2"></div>
          <div class="col-12 col-md-8">
            <div class="text-subtitle2 text-justify q-mb-md text-bold text-indigo-10">
              "En el siguiente formulario se recabará toda la información principal para su Inscripción y posterior certificación en la finalización de las jornadas. Se le insinúa llenar el NOMBRE COMPLETO Y LA PROFESIÓN  de forma correcta."
            </div>
          </div>
          <div class="col-12 col-md-2"></div>
          <div class="col-12 col-md-2"></div>
          <div class="col-12 col-md-8">
            <q-card flat bordered>
              <q-card-section>
                <q-form class="q-gutter-md" @submit.prevent="registrarUsuario">
                  <q-input filled v-model="user.firstSurname" label="Primer Apellido" ></q-input>
                  <q-input filled v-model="user.secondSurname" label="Segundo Apellido" ></q-input>
                  <q-input filled v-model="user.firstName" label="Primer Nombre" required ></q-input>
                  <q-input filled v-model="user.secondName" label="Segundo Nombre" ></q-input>
                  <!--              <q-input filled v-model="user.name" label="Nombre Completo:" required ></q-input>-->
                  <q-input filled v-model="user.ci" label="Carnet" required ></q-input>
                  <q-input filled v-model="user.phone" label="Celular" required type="number" ></q-input>
                  <q-input filled v-model="user.email" label="Correo Electrónico:" ></q-input>
                  <!--              <q-option-group v-value="user.profession" :options="profesiones" label="Profesión:" required/>-->
                  <template v-for="(profession, index) in profesiones"
                            :key="index">
                    <div class="text-left">
                      <q-radio
                        v-model="user.profession"
                        dense
                        class="text-subtitle2"
                        :label="profession"
                        :val="profession"
                      />
                    </div>
                  </template>
                  <q-input
                    v-if="user.profession === 'Otros'"
                    filled v-model="user.professionOther" label="Especifique su profesión"/>
                  <q-select
                    filled
                    v-model="user.departamento"
                    label="Departamento:"
                    :options="[
                  { label: 'La Paz', value: 'La Paz' },
                  { label: 'Cochabamba', value: 'Cochabamba' },
                  { label: 'Santa Cruz', value: 'Santa Cruz' },
                  { label: 'Tarija', value: 'Tarija' },
                  { label: 'Potosí', value: 'Potosí' },
                  { label: 'Oruro', value: 'Oruro' },
                  { label: 'Chuquisaca', value: 'Chuquisaca' },
                  { label: 'Beni', value: 'Beni' },
                  { label: 'Pando', value: 'Pando' },
                  { label: 'Beni', value: 'Beni' }
                ]"
                    required
                    emit-value
                    map-options
                  />
                  <q-input v-model="user.provincia" filled label="Provincia/Municipio/Region:" required ></q-input>
                  <q-input v-model="user.direccion" filled label="Dirección:" required ></q-input>

<!--                  -Inscribirse a las Jornadas-->
<!--                  -Inscribirse al Taller-->
<!--                  -Inscribirse a ambos-->
<!--                  <q-checkbox v-model="user.cursoTaller"-->
<!--                              label="Va a asistir al curso taller?"-->
<!--                  />-->
                  <template v-for="(checkbox, index) in ['Inscribirse a las Jornadas', 'Inscribirse al Taller', 'Inscribirse a ambos']"
                            :key="index">
                    <div class="text-left">
                      <q-radio
                        v-model="user.cursoTaller"
                        dense
                        class="text-subtitle2"
                        :label="checkbox"
                        :val="checkbox"
                      />
                    </div>
                  </template>
<!--                  <pre>{{user.cursoTaller}}</pre>-->
<!--                  <div class="bg-red text-white text-h5" v-if="user.cursoTaller== 'Inscribirse al Taller'">-->
<!--                    Debe cancelar el monto Adicional de 70 Bs. por el curso taller.-->
<!--                  </div>-->
                  <div class="text-bold text-h5 ">
                    Comprobante de pago de Inscripción Jornadas
                  </div>
<!--                  <q-chip mensajeCosto-->
                  <div
                    v-if="user.cursoTaller === 'Inscribirse al Taller' || user.cursoTaller === 'Inscribirse a ambos'"
                    class="bg-red text-white"
                  >
                    {{ mensajeCosto }}
                  </div>
                  <q-file
                    filled
                    v-model="user.file"
                    label="Subir Comprobante de Inscripción"
                    accept=".pdf, image/*"
                    use-chips
                  />
<!--                  <template v-if="user.cursoTaller">-->
<!--                    <div class="text-bold text-h5">-->
<!--                      Comprobante de pago Inscripción Curso Taller de 70 Bs-->
<!--                    </div>-->
<!--                    <q-file-->
<!--                      filled-->
<!--                      v-model="user.file2"-->
<!--                      label="Comprobante de Inscripción"-->
<!--                      accept=".pdf, image/*"-->
<!--                      use-chips-->
<!--                    />-->
<!--                  </template>-->
<!--                  <div>-->
<!--                    <pre>{{user}}</pre>-->
<!--                  </div>-->
                  <div>
                    <q-img src="aviso.jpg" class="q-mb-md" />
                  </div>
                  <div>
                    <q-btn
                      label="Enviar"
                      color="primary"
                      class="full-width text-bold text-white"
                      type="submit"
                      icon="send"
                      no-caps
                      :loading="loading"
                    />
                  </div>
                  <div>
                    <q-btn
                      label="Volver a la página principal"
                      color="primary"
                      class="full-width text-bold"
                      to="/"
                      no-caps
                      outline
                      icon="home"
                      :loading="loading"
                    />
                  </div>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
          <div class="col-12 col-md-2"></div>
        </div>
      </q-page>
    </q-page-container>
    <FooterComponent></FooterComponent>
  </q-layout>
</template>

<script>
import FooterComponent from 'components/FooterComponent.vue'

export default {
  name: 'RegistroPage',
  components: { FooterComponent },
  data () {
    return {
      profesiones: [
        'Medico General',
        'Especialista',
        'Lic. en Fisioterapia',
        'Lic. en Enfermeria',
        'Aux. en Enfermeria',
        'Estudiante',
        'Otros'
      ],
      loading: false,
      user: {
        firstSurname: '',
        secondSurname: '',
        firstName: '',
        secondName: '',
        // name: '',
        ci: '',
        phone: '',
        email: '',
        profession: '',
        professionOther: '',
        departamento: '',
        provincia: '',
        direccion: '',
        cursoTaller: 'Inscribirse a las Jornadas',
        file: null,
        file2: null
      }
    }
  },
  methods: {
    async registrarUsuario () {
      const formData = new FormData()
      for (const key in this.user) {
        if (this.user[key] !== null && this.user[key] !== '') {
          if (key === 'file' || key === 'file2') {
            if (this.user[key]) {
              formData.append(key, this.user[key])
            }
          } else {
            formData.append(key, this.user[key])
          }
        }
      }

      try {
        this.loading = true
        await this.$axios.post('registro', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }).finally(() => {
          this.loading = false
        })
        this.$q.notify({ type: 'positive', message: 'Inscripción completada', position: 'top' })
        this.user = {
          firstSurname: '',
          secondSurname: '',
          firstName: '',
          secondName: '',
          // name: '',
          ci: '',
          phone: '',
          email: '',
          profession: '',
          professionOther: '',
          departamento: '',
          provincia: '',
          direccion: '',
          cursoTaller: false,
          file: null,
          file2: null
        }
        const url = 'https://chat.whatsapp.com/EbTwZvGCYoe0ZpGkrSjPd8'
        window.open(url, '_blank')
      } catch (err) {
        console.log(err.response.data)
        this.$q.notify({ type: 'negative', message: err.response.data.message, position: 'top' })
        console.error(err.response?.data || err.message)
      }
    }
  },
  // computed mensajeCosto
  computed: {
    mensajeCosto () {
      if (this.user.cursoTaller === 'Inscribirse a las Jornadas') {
        return 'Comprobante de Inscripción'
      } else if (this.user.cursoTaller === 'Inscribirse al Taller') {
        return 'Costo de inscripción 70 bs'
      } else if (this.user.cursoTaller === 'Inscribirse a ambos') {
        return 'Debe cancelar un costo adicional de 70 bs. Por el Curso Taller'
      }
      return 'Comprobante de Inscripción'
    }
  }
}
</script>

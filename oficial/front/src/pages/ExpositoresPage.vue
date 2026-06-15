<template>
  <q-page class="q-pa-md bg-grey-1">
    <div class="text-h5 text-primary text-center q-mb-md text-center text-h3">
      Expositores Jornadas
    </div>

    <!-- Jornadas agrupadas -->
    <div v-for="(lista, fecha) in jornadasAgrupadas" :key="fecha" class="q-mb-xl">
      <div class="text-h6 text-bold text-blue-10 q-mb-sm">
        {{ fecha }}
      </div>
      <q-card flat bordered class="q-pa-md bg-white">
        <q-item v-for="(expo, i) in lista" :key="i" class="q-mb-sm">
          <q-item-section avatar>
            <q-avatar size="56px" rounded>
              <img :src="expo.avatar || defaultAvatar" alt="avatar" />
            </q-avatar>
          </q-item-section>
          <q-item-section>
            <q-item-label class="text-subtitle1 text-weight-medium">{{ expo.title }}</q-item-label>
            <q-item-label caption class="text-grey-7">
              {{ expo.hora }} – {{ expo.text }}
            </q-item-label>
            <q-item-label v-if="expo.content" caption class="text-blue-8">
              {{ expo.content }}
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-card>
    </div>

    <!-- Talleres sin agrupar -->
    <div class="text-h6 text-bold text-black q-mb-sm text-center text-h3">
      Expositores  Talleres
    </div>
    <q-card flat bordered class="q-pa-md bg-white">
      <q-item v-for="(expo, i) in talleres" :key="'t-' + i" class="q-mb-sm">
        <q-item-section avatar>
          <q-avatar size="56px" rounded>
            <img :src="expo.avatar || defaultAvatar" alt="avatar" />
          </q-avatar>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-subtitle1 text-weight-medium">{{ expo.title }}</q-item-label>
          <q-item-label caption class="text-grey-7">
            {{ expo.hora }} – {{ expo.text }}
          </q-item-label>
          <q-item-label v-if="expo.content" caption class="text-blue-8">
            {{ expo.content }}
          </q-item-label>
        </q-item-section>
      </q-item>
    </q-card>
  </q-page>
</template>

<script>
export default {
  name: 'ExpositoresPage',
  data () {
    return {
      expositores: [],
      defaultAvatar: 'https://www.w3schools.com/howto/img_avatar.png'
    }
  },
  computed: {
    jornadasAgrupadas () {
      const dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado']
      const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre']

      const grupos = {}

      this.expositores
        .filter(e => e.tipo === 'Jornada')
        .forEach(expo => {
          const partes = expo.date.split('-')
          const d = new Date(Number(partes[0]), Number(partes[1]) - 1, Number(partes[2]))
          const diaSemana = dias[d.getDay()]
          const dia = d.getDate()
          const mes = meses[d.getMonth()]
          const fechaTitulo = `${this.capitalize(diaSemana)} ${dia} de ${this.capitalize(mes)}`

          if (!grupos[expo.date]) grupos[expo.date] = { titulo: fechaTitulo, expos: [] }
          grupos[expo.date].expos.push(expo)
        })

      // Ordenar por fecha
      const ordenado = Object.keys(grupos).sort((a, b) => new Date(a) - new Date(b))

      return ordenado.reduce((acc, clave) => {
        acc[grupos[clave].titulo] = grupos[clave].expos
        return acc
      }, {})
    },
    talleres () {
      return this.expositores.filter(e => e.tipo === 'Taller')
    }
  },
  mounted () {
    this.getExpositores()
  },
  methods: {
    capitalize (str) {
      return str.charAt(0).toUpperCase() + str.slice(1)
    },
    getExpositores () {
      this.$axios.get('expositores')
        .then(res => {
          this.expositores = res.data
        })
        .catch(err => {
          this.$alert.error(err.response?.data?.message || 'Error al cargar expositores')
        })
    }
  }
}
</script>

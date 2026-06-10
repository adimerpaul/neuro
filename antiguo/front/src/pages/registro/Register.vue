<template>
  <q-page class="bg-grey-3 q-pa-md">
    <q-card flat bordered>
      <q-card-section class="q-pa-xs">
        <div class="row">
          <div class="col-12 col-md-1">
            <div>Total Registros: </div>
            <div class="text-center">
              <strong>{{ registros.length }}</strong>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <q-input
              v-model="search"
              dense
              outlined
              label="Buscar"
              class="q-mb-md"
              @update:modelValue="filterRegistros"
            />
          </div>
          <div class="col-12 col-md-2">
            <q-btn @click="registroGet" color="primary" label="Actualizar" class="q-mb-md" no-caps :loading="loading"
                   icon="refresh" />
          </div>
          <div class="col-12 col-md-5 text-right">
            <q-btn-dropdown color="secondary q-mb-md q-mr-md" text-color="white" label="Reportes" no-caps :loading="loading">
              <q-list>
                <q-item clickable @click="imprimirReporteCurso" v-close-popup>
                  <q-item-section avatar>
                    <q-icon name="print" />
                  </q-item-section>
                  <q-item-section>Reporte por Curso/Taller</q-item-section>
                </q-item>
                <q-item clickable @click="exportarExcel" v-close-popup>
                  <q-item-section avatar>
                    <q-icon name="file_download" />
                  </q-item-section>
                  <q-item-section>Excel inscritor</q-item-section>
                </q-item>
                <q-item clickable @click="exportarVideosJornadas" v-close-popup>
                  <q-item-section avatar>
                    <q-icon name="file_download" />
                  </q-item-section>
                  <q-item-section>Excel expocitores</q-item-section>
                </q-item>
                <q-item clickable @click="exportarInscritosPDF" v-close-popup>
                  <q-item-section avatar><q-icon name="picture_as_pdf" /></q-item-section>
                  <q-item-section>PDF inscritos</q-item-section>
                </q-item>

                <q-item clickable @click="exportarExpositoresPDF" v-close-popup>
                  <q-item-section avatar><q-icon name="picture_as_pdf" /></q-item-section>
                  <q-item-section>PDF expositores</q-item-section>
                </q-item>
                <q-item clickable @click="exportarInscritosPorCursoPDF" v-close-popup>
                  <q-item-section avatar><q-icon name="picture_as_pdf" /></q-item-section>
                  <q-item-section>PDF por Curso/Taller</q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
            <q-btn @click="clickRegistrar" color="green" label="Crear" class="q-mb-md" no-caps icon="add_circle" />
          </div>
        </div>
      </q-card-section>
    </q-card>
    <q-markup-table dense wrap-cells flat bordered>
      <thead>
      <tr>
        <th>Opciones</th>
        <th>Nombre Completo</th>
        <th>CI</th>
        <th>Teléfono</th>
        <th>Ver foto</th>
<!--        <th>Ver foto</th>-->
        <th>Email</th>
        <th>Profesión</th>
        <th>Departamento</th>
        <th>Provincia</th>
        <th>Dirección</th>
        <th>Curso/Taller</th>
        <th>Fecha</th>
        <th>Observación</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(registro, index) in registros" :key="index">
<!--        cambiar bg-red si tiene observacion-->
        <tr :class="{ 'bg-red-1': registro.observacion }">
          <td>
            <div style="display: flex; align-items: center; gap: 5px;">
              {{ index + 1 }}
              <q-btn-dropdown color="primary" text-color="white" dense label="Opciones" no-caps size="xs" :loading="loading">
                <q-list>
                  <q-item clickable @click="crearUsuario(registro)" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="person_add" />
                    </q-item-section>
                    <q-item-section>Crear usuario</q-item-section>
                  </q-item>
                  <q-item clickable @click="mandarRegistro(registro)" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="fa-brands fa-whatsapp" />
                    </q-item-section>
                    <q-item-section>Mandar por WhatsApp</q-item-section>
                  </q-item>
<!--                  oobservacion-->
                  <q-item clickable @click="dialogObservacion = true; this.registro = registro" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="comment" />
                    </q-item-section>
                    <q-item-section>Observación</q-item-section>
                  </q-item>
                  <q-item clickable @click="editarRegistro(registro)" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="visibility" />
                    </q-item-section>
                    <q-item-section>Ver</q-item-section>
                  </q-item>
                  <q-item clickable @click="eliminarRegistro(registro)" v-close-popup>
                    <q-item-section avatar>
                      <q-icon name="delete" />
                    </q-item-section>
                    <q-item-section>Eliminar</q-item-section>
                  </q-item>
                </q-list>
              </q-btn-dropdown>
            </div>
          </td>
          <td>{{ registro.firstSurname }} {{ registro.secondSurname }} {{ registro.firstName }} {{ registro.secondName }}</td>
          <td>{{ registro.ci }}</td>
          <td>{{ registro.phone }}</td>
          <td>
            <a :href="`${$url}../storage/${registro.file}`" target="_blank" title="Ver foto 1" >
              <q-img
                :src="`${$url}../storage/${registro.file}`"
                style="max-width: 100px; max-height: 100px;"
              />
            </a>
            <a :href="`${$url}../storage/${registro.file2}`" target="_blank" title="Ver foto 2" >
              <q-img
                :src="`${$url}../storage/${registro.file2}`"
                style="max-width: 100px; max-height: 100px;"
              />
            </a>
            <!--          <pre>{{registro}}</pre>-->
          </td>
          <!--        <td>-->
          <!--          <q-img-->
          <!--            :src="`${$url}../storage/${registro.file2}`"-->
          <!--            style="max-width: 100px; max-height: 100px;"-->
          <!--            @click="verFoto(registro.file2)"-->
          <!--          />-->
          <!--        </td>-->
          <td>{{ registro.email }}</td>
          <td>{{ registro.profession }}</td>
          <td>{{ registro.departamento }}</td>
          <td>{{ registro.provincia }}</td>
          <td>{{ registro.direccion }}</td>
          <td>{{ registro.cursoTaller }}</td>
          <td>{{ $filters.datedmYHi(registro.created_at) }}</td>
          <td>
          <span v-if="registro.observacion" class="text-red text-bold">
            {{ registro.observacion }}
          </span>
          </td>
        </tr>
      </template>
      </tbody>
    </q-markup-table>
<!--    <pre>{{registros}}</pre>-->
<!--    [-->
<!--    {-->
<!--    "id": 2,-->
<!--    "firstSurname": "bbb",-->
<!--    "secondSurname": "bb",-->
<!--    "firstName": "bb",-->
<!--    "secondName": "bb",-->
<!--    "ci": "2342",-->
<!--    "phone": "23432",-->
<!--    "email": "adimer101@gmail.com",-->
<!--    "profession": "Especialista",-->
<!--    "professionOther": null,-->
<!--    "departamento": "Beni",-->
<!--    "provincia": "bolvia/cercado/oruro",-->
<!--    "direccion": "avenida dn y tartawoski",-->
<!--    "cursoTaller": 1,-->
<!--    "file": "comprobantes/1cSY4QK5cT9LGi9oKUJX0Qz06uPFrObqn1WPajIA.png",-->
<!--    "file2": null-->
<!--    },-->
    <q-dialog v-model="registroDialog" persistent>
      <q-card>
        <q-card-section class="q-pb-none">
          {{ registro.id ? 'Editar Registro' : 'Crear Registro' }}
          <q-btn flat icon="close" @click="registroDialog = false" class="absolute-top-right q-mt-xs q-mr-xs" />
        </q-card-section>
        <q-card-section>
          <q-form @submit.prevent="submit">
            <q-input v-model="registro.firstSurname" dense outlined label="Apellido Paterno" />
            <q-input v-model="registro.secondSurname" dense outlined label="Apellido Materno" />
            <q-input v-model="registro.firstName" dense outlined label="Nombre" />
            <q-input v-model="registro.secondName" dense outlined label="Segundo Nombre" />
            <q-input v-model="registro.ci" dense outlined label="CI" />
            <q-input v-model="registro.phone" dense outlined label="Teléfono" />
            <q-input v-model="registro.email" dense outlined label="Email" type="email" />
            <q-input v-model="registro.profession" dense outlined label="Profesión" />
            <q-input v-model="registro.departamento" dense outlined label="Departamento" />
            <q-input v-model="registro.provincia" dense outlined label="Provincia" />
            <q-input v-model="registro.direccion" dense outlined label="Dirección" />
            <q-input v-model="registro.cursoTaller" dense outlined label="Curso/Taller" />
<!--            file file2-->
            <q-file v-model="registro.file" dense outlined label="Comprobante de pago" type="file" />
            <q-file v-model="registro.file2" dense outlined label="Comprobante de pago 2" type="file" />
            <q-input v-model="registro.observacion" dense outlined label="Observacion" type="textarea" />
            <div class="q-mt-md">
              <q-btn type="submit" color="primary" :loading="loading">Guardar</q-btn>
              <q-btn flat @click="registroDialog = false" :loading="loading">Cancelar</q-btn>
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
    <q-dialog v-model="dialogObservacion" persistent>
      <q-card>
        <q-card-section class="q-pb-none">
          Observación
          <q-btn flat icon="close" @click="dialogObservacion = false" class="absolute-top-right q-mt-xs q-mr-xs" />
        </q-card-section>
        <q-card-section>
          <q-form >
          <q-input v-model="registro.observacion" dense outlined label="Observación" type="textarea" />
          <div class="q-mt-md">
            <q-btn outline @click="dialogObservacion = false" color="primary" class="q-mr-sm" :loading="loading">Cerrar</q-btn>
            <q-btn @click="updateRegistro" color="primary" :loading="loading">Guardar</q-btn>
          </div>
          </q-form>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import { Printd } from 'printd'
import xlsx from 'json-as-xlsx'
import jsPDF from 'jspdf'
import autoTable from 'jspdf-autotable'
export default {
  name: 'RegisterPage',
  data () {
    return {
      loading: false,
      registros: [],
      registrosAll: [],
      registro: {},
      registroDialog: false,
      search: '',
      dialogObservacion: false,
      videos: []
    }
  },
  mounted () {
    this.registroGet()
    this.videosGetAll()
  },
  methods: {
    exportarInscritosPorCursoPDF () {
      // eslint-disable-next-line new-cap
      const doc = new jsPDF()
      doc.setFontSize(16)
      doc.text('LISTADO DE INSCRITOS POR CURSO/TALLER', 14, 15)

      const grupos = {
        'Inscribirse a las Jornadas': [],
        'Inscribirse al Taller': []
      }

      this.registrosAll.forEach(r => {
        const nombreCompleto = `${r.firstSurname} ${r.secondSurname} ${r.firstName} ${r.secondName}`
        if (r.cursoTaller === 'Inscribirse a ambos') {
          grupos['Inscribirse a las Jornadas'].push(nombreCompleto)
          grupos['Inscribirse al Taller'].push(nombreCompleto)
        } else if (grupos[r.cursoTaller]) {
          grupos[r.cursoTaller].push(nombreCompleto)
        }
      })

      const tableHeaders = [['#', 'Nombre Completo']]
      const currentY = 25

      Object.entries(grupos).forEach(([titulo, nombres], idx) => {
        if (idx > 0) doc.addPage()
        doc.setFontSize(14)
        doc.text(`Curso/Taller: ${titulo}`, 14, currentY)

        const body = nombres.map((nombre, i) => [i + 1, nombre])

        autoTable(doc, {
          startY: currentY + 5,
          head: tableHeaders,
          body,
          styles: { fontSize: 10 },
          margin: { left: 14, right: 14 },
          didDrawPage: function (data) {
            // Posición final después de la tabla
            const finalY = data.cursor.y + 10
            doc.setFontSize(12)
            doc.text(`Total inscritos: ${nombres.length}`, 14, finalY)
          }
        })
      })

      doc.save(`Inscritos_por_Curso_${new Date().toISOString().split('T')[0]}.pdf`)
    },
    exportarInscritosPDF () {
      // eslint-disable-next-line new-cap
      const doc = new jsPDF()
      doc.setFontSize(14)
      doc.text('Listado de Inscritos', 14, 15)

      const rows = this.registrosAll.map((r, i) => [
        i + 1,
        `${r.firstSurname} ${r.secondSurname} ${r.firstName} ${r.secondName}`,
        r.ci,
        r.phone,
        r.email,
        r.profession,
        r.cursoTaller,
        new Date(r.created_at).toLocaleString()
      ])

      autoTable(doc, {
        startY: 20,
        head: [['#', 'Nombre Completo', 'CI', 'Teléfono', 'Email', 'Profesión', 'Curso/Taller', 'Fecha']],
        body: rows,
        styles: { fontSize: 8 }
      })

      doc.save(`Inscritos_${new Date().toISOString().split('T')[0]}.pdf`)
    },
    exportarExpositoresPDF () {
      const jornadas = this.videos.filter(video => video.tipo === 'Jornada')

      // eslint-disable-next-line new-cap
      const doc = new jsPDF()
      doc.setFontSize(14)
      doc.text('Listado de Expositores (Jornadas)', 14, 15)

      const rows = jornadas.map((v, i) => [
        i + 1,
        v.title,
        v.subtitle,
        new Date(v.date).toLocaleDateString(),
        v.urlZoom || '-',
        v.urlYoutube || '-'
      ])

      autoTable(doc, {
        startY: 20,
        head: [['#', 'Título', 'Subtítulo', 'Fecha', 'Zoom', 'YouTube']],
        body: rows,
        styles: { fontSize: 8 }
      })

      doc.save(`Expositores_Jornadas_${new Date().toISOString().split('T')[0]}.pdf`)
    },
    exportarVideosJornadas () {
      const jornadas = this.videos.filter(video => video.tipo === 'Jornada')

      const data = [
        {
          sheet: 'Jornadas',
          columns: [
            { label: 'Título', value: 'title' },
            { label: 'Subtítulo', value: 'subtitle' },
            { label: 'Contenido', value: 'content' },
            { label: 'Fecha', value: row => new Date(row.date).toLocaleString() },
            { label: 'Zoom', value: 'urlZoom' },
            { label: 'YouTube', value: 'urlYoutube' },
            { label: 'Estado botón', value: row => row.button === 1 ? 'Activo' : 'Inactivo' }
          ],
          content: jornadas
        }
      ]

      const settings = {
        fileName: `Videos_Jornadas_${new Date().toISOString().split('T')[0]}`
      }

      xlsx(data, settings)
    },
    videosGetAll () {
      this.$axios.get('/videosAll')
        .then(response => {
          this.videos = response.data
        })
        .catch(error => {
          console.error('Error fetching videos:', error)
        })
    },
    exportarExcel () {
      const data = [
        {
          sheet: 'Inscritos',
          columns: [
            { label: 'Nro', value: 'nro' },
            { label: 'Apellido Paterno', value: 'firstSurname' },
            { label: 'Apellido Materno', value: 'secondSurname' },
            { label: 'Nombre', value: 'firstName' },
            { label: 'Segundo Nombre', value: 'secondName' },
            { label: 'CI', value: 'ci' },
            { label: 'Teléfono', value: 'phone' },
            { label: 'Email', value: 'email' },
            { label: 'Profesión', value: 'profession' },
            { label: 'Departamento', value: 'departamento' },
            { label: 'Provincia', value: 'provincia' },
            { label: 'Dirección', value: 'direccion' },
            { label: 'Curso/Taller', value: 'cursoTaller' },
            { label: 'Observación', value: 'observacion' },
            { label: 'Fecha', value: row => new Date(row.created_at).toLocaleString() },
            { label: 'Comprobante 1', value: row => `${this.$url}../storage/${row.file}` },
            { label: 'Comprobante 2', value: row => row.file2 ? `${this.$url}../storage/${row.file2}` : '' }
          ],
          content: this.registrosAll.map((r, i) => ({
            ...r,
            nro: i + 1
          }))
        }
      ]

      const settings = {
        fileName: `Reporte_Inscritos_${new Date().toISOString().split('T')[0]}`, // sin extensión
        extraLength: 3 // espacio adicional para celdas grandes
      }

      xlsx(data, settings)
    },
    imprimirReporteCurso () {
      const data = this.agruparPorCursoTaller()
      const filas = Object.entries(data).map(([curso, cantidad], index) => `
    <tr>
      <td>${index + 1}</td>
      <td>${curso}</td>
      <td style="text-align: right">${cantidad}</td>
    </tr>
  `).join('')

      const html = `
    <style>
      body { font-family: Arial, sans-serif; padding: 20px; }
      h2 { text-align: center; }
      table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
      th, td { border: 1px solid #000; padding: 6px; }
      th { background-color: #f0f0f0; }
    </style>
    <h2>REPORTE DE INSCRITOS POR CURSO/TALLER</h2>
    <p>Total registros: ${this.registrosAll.length}</p>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Curso/Taller</th>
          <th>Inscritos</th>
        </tr>
      </thead>
      <tbody>${filas}</tbody>
    </table>
  `

      const d = new Printd()
      const frag = document.createRange().createContextualFragment(html)
      d.print(frag)
    },
    agruparPorCursoTaller () {
      const conteo = {}

      this.registrosAll.forEach(registro => {
        const clave = registro.cursoTaller || 'Sin especificar'
        if (!conteo[clave]) {
          conteo[clave] = 0
        }
        conteo[clave]++
      })

      return conteo
    },
    filterRegistros () {
      if (this.search) {
        this.registros = this.registrosAll.filter(registro => {
          return (
            registro.firstSurname?.toLowerCase().includes(this.search.toLowerCase()) ||
            registro.secondSurname?.toLowerCase().includes(this.search.toLowerCase()) ||
            registro.firstName?.toLowerCase().includes(this.search.toLowerCase()) ||
            registro.secondName?.toLowerCase().includes(this.search.toLowerCase()) ||
            registro.ci.includes(this.search) ||
            registro.phone.includes(this.search) ||
            registro.email?.toLowerCase().includes(this.search.toLowerCase())
          )
        })
      } else {
        this.registros = this.registrosAll
      }
    },
    clickRegistrar () {
      this.registro = {}
      this.registroDialog = true
    },
    submit () {
      if (this.registro.id) {
        this.updateRegistro()
      } else {
        this.crearRegistro()
      }
    },
    updateRegistro () {
      this.loading = true
      const formData = new FormData()
      formData.append('id', this.registro.id)
      formData.append('firstSurname', this.registro.firstSurname)
      formData.append('secondSurname', this.registro.secondSurname)
      formData.append('firstName', this.registro.firstName)
      formData.append('secondName', this.registro.secondName)
      formData.append('ci', this.registro.ci)
      formData.append('phone', this.registro.phone)
      formData.append('email', this.registro.email)
      formData.append('profession', this.registro.profession)
      formData.append('departamento', this.registro.departamento)
      formData.append('provincia', this.registro.provincia)
      formData.append('direccion', this.registro.direccion)
      formData.append('cursoTaller', this.registro.cursoTaller)
      formData.append('observacion', this.registro.observacion || '')
      if (this.registro.file) {
        formData.append('file', this.registro.file)
      }
      if (this.registro.file2) {
        formData.append('file2', this.registro.file2)
      }
      this.$axios.post(`registro/${this.registro.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(res => {
          this.$q.notify({ type: 'positive', message: 'Registro actualizado', position: 'top' })
          this.registroGet()
        })
        .catch(err => {
          const msg = err.response?.data?.message || 'Error al actualizar registro'
          this.$q.notify({ type: 'red', message: msg, position: 'top' })
        })
        .finally(() => {
          this.registroDialog = false
          this.loading = false
          this.dialogObservacion = false
        })
    },
    crearRegistro () {
      this.loading = true
      const formData = new FormData()
      formData.append('firstName', this.registro.firstName)
      formData.append('firstSurname', this.registro.firstSurname)
      formData.append('secondSurname', this.registro.secondSurname)
      formData.append('ci', this.registro.ci)
      formData.append('phone', this.registro.phone)
      formData.append('email', this.registro.email)
      formData.append('profession', this.registro.profession)
      formData.append('departamento', this.registro.departamento)
      formData.append('provincia', this.registro.provincia)
      formData.append('direccion', this.registro.direccion)
      formData.append('cursoTaller', this.registro.cursoTaller)
      formData.append('file', this.registro.file)
      formData.append('file2', this.registro.file2)
      formData.append('observacion', this.registro.observacion || '')
      this.$axios.post('registro', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(res => {
          this.$q.notify({ type: 'positive', message: res.data.message, position: 'top' })
          this.registroGet()
        })
        .catch(err => {
          const msg = err.response?.data?.message || 'Error al crear registro'
          this.$q.notify({ type: 'red', message: msg, position: 'top' })
        })
        .finally(() => {
          this.registroDialog = false
          this.loading = false
        })
    },
    eliminarRegistro (registro) {
      this.$q.dialog({
        title: 'Eliminar Registro',
        message: `¿Está seguro de eliminar el registro de ${registro.firstName} ${registro.firstSurname}?`,
        cancel: true,
        persistent: true
      }).onOk(() => {
        this.loading = true
        this.$axios.delete(`registro/${registro.id}`)
          .then(res => {
            this.$q.notify({ type: 'positive', message: res.data.message, position: 'top' })
            this.registroGet()
          })
          .catch(err => {
            const msg = err.response?.data?.message || 'Error al eliminar registro'
            this.$q.notify({ type: 'red', message: msg, position: 'top' })
          })
          .finally(() => {
            this.loading = false
          })
      })
    },
    editarRegistro (registro) {
      this.registro = { ...registro }
      this.registroDialog = true
    },
    mandarRegistro (registro) {
      const numero = registro.phone.replace(/\D/g, '') // limpia espacios o guiones
      let mensaje = `Hola ${registro.firstName}, te damos la bienvenida. Tu cuenta ha sido creada:\n\nUsuario: ${registro.ci}\nContraseña: ${registro.ci}`
      mensaje += '\n\nPara más información visita: https://jornadasimposioneurooruro.org/'
      const url = `https://wa.me/591${numero}?text=${encodeURIComponent(mensaje)}`
      window.open(url, '_blank')
    },
    crearUsuario (registro) {
      this.$q.loading.show()
      this.$axios.post('/registro/crear-usuario', { id: registro.id })
        .then(res => {
          this.$q.notify({ type: 'positive', message: res.data.message, position: 'top' })
        })
        .catch(err => {
          const msg = err.response?.data?.message || 'Error al crear usuario'
          this.$q.notify({ type: 'warning', message: msg, position: 'top' })
        })
        .finally(() => {
          this.$q.loading.hide()
        })
    },
    verFoto (file) {
      this.$q.dialog({
        title: 'Ver foto',
        message: `<img src="${this.$url}../storage/${file}" style="max-width: 100%; max-height: 100%;" />`,
        persistent: true,
        html: true
      })
    },
    registroGet () {
      this.loading = true
      this.$axios.get('/registro')
        .then(response => {
          this.registros = response.data
          this.registrosAll = response.data
          this.loading = false
        })
        .catch(error => {
          console.error('Error fetching registros:', error)
          this.loading = false
        })
    }
  }
}
</script>

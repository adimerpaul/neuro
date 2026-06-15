<template>
  <q-page class="q-pa-md bg-grey-3">
    <q-timeline color="secondary">
      <q-timeline-entry heading>
        <template v-if="date=='t'">
          1er CURSO TALLER DE EXPLORACIÓN NEUROLÓGICA
        </template>
        <template v-else>
        {{ $filters.dateDmY(date) }}
        </template>
        <q-btn flat round dense icon="o_refresh" @click="videosGet" :loading="loading" />
      </q-timeline-entry>
      <q-timeline-entry v-for="(video,i) in videos" :key="i.title"
        :subtitle="video.subtitle"
        :title="video.title"
        :avatar="video.avatar?video.avatar:undefined"
      >
        <div>
          <div v-html="video.content"></div>
          <div>
            <template v-if="video.button">
              <q-btn style="width: 170px" size="12px" outline label="Hoja de vida" color="blue" class="q-ma-xs" no-caps
                     icon-right="o_file_download" type="a" :href="video.hojaVida"
                     target="_blank" v-if="video.hojaVida"/>
              <q-btn style="width: 170px" size="12px" label="Material estudio" color="blue-10" class="q-ma-xs" no-caps
                     icon-right="o_file_download" type="a" :href="video.materialEstudio"
                     target="_blank" v-if="video.materialEstudio"/>
              <q-btn style="width: 170px" size="12px" label="Ingresa a la sala" color="blue" class="q-ma-xs" no-caps
                     icon-right="o_videocam" type="a" :href="video.urlZoom"
                     target="_blank" v-if="video.urlZoom"
              />
              <q-btn style="width: 170px" size="12px" label="Ver video" color="red" class="q-ma-xs" no-caps
                     icon-right="fa-brands fa-youtube" type="a" :href="video.urlYoutube"
                     target="_blank" v-if="video.urlYoutube" @click="verVideo(video)"
              />
<!--              botn diapositiva orange-->
              <q-btn style="width: 170px" size="12px" label="Ver diapositiva" color="orange" class="q-ma-xs" no-caps
                     icon-right="o_file_download" type="a" :href="video.diapositivas"
                     target="_blank" v-if="video.diapositivas"/>
            </template>
          </div>
        </div>
      </q-timeline-entry>
    </q-timeline>
  </q-page>
</template>
<script>
export default {
  name: 'Dia13Page',
  data () {
    return {
      videos: [],
      date: this.$route.params.date,
      loading: false
    }
  },
  created () {
    this.$watch('$route.params.date', (value) => {
      this.date = value
      this.videosGet()
    })
    this.videosGet()
  },
  methods: {
    verVideo (video) {
      this.$axios.post('verVideo', video).then(response => {
        // this.$alert.success(response.data.message)
        this.$store.porcentaje = response.data
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      })
    },
    videosGet () {
      this.videos = []
      this.loading = true
      this.$axios.get('videos', {
        params: { date: this.date }
      }).then(response => {
        this.videos = response.data
      }).catch(error => {
        this.$alert.error(error.response.data.message)
      }).finally(() => {
        this.loading = false
      })
    }
  }
}
</script>
<style scoped lang="sass">

</style>
